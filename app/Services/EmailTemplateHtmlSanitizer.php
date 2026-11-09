<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;

class EmailTemplateHtmlSanitizer
{
    /** @var list<string> */
    private const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 'ul', 'ol', 'li',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'a',
    ];

    public function sanitize(string $html): string
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8"><div>'.$html.'</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $root = $document->getElementsByTagName('div')->item(0);

        if (! $root) {
            return '';
        }

        $this->sanitizeChildren($root);
        $clean = '';

        foreach ($root->childNodes as $child) {
            $clean .= $document->saveHTML($child);
        }

        return $clean;
    }

    private function sanitizeChildren(DOMNode $parent): void
    {
        foreach (iterator_to_array($parent->childNodes) as $node) {
            if (! $node instanceof DOMElement) {
                continue;
            }

            $tag = strtolower($node->tagName);

            if ($tag === 'ol') {
                foreach ($node->childNodes as $child) {
                    if ($child instanceof DOMElement
                        && strtolower($child->tagName) === 'li'
                        && $child->getAttribute('data-list') === 'bullet') {
                        $replacement = $parent->ownerDocument->createElement('ul');

                        while ($node->firstChild) {
                            $replacement->appendChild($node->firstChild);
                        }

                        $parent->replaceChild($replacement, $node);
                        $node = $replacement;
                        $tag = 'ul';

                        break;
                    }
                }
            }

            if (in_array($tag, ['script', 'style', 'iframe', 'object', 'embed', 'svg', 'math'], true)) {
                $parent->removeChild($node);

                continue;
            }

            $this->sanitizeChildren($node);

            if (! in_array($tag, self::ALLOWED_TAGS, true)) {
                while ($node->firstChild) {
                    $parent->insertBefore($node->firstChild, $node);
                }
                $parent->removeChild($node);

                continue;
            }

            $allowedAttributes = $tag === 'a' ? ['href', 'title'] : [];

            foreach (iterator_to_array($node->attributes) as $attribute) {
                if (! in_array(strtolower($attribute->name), $allowedAttributes, true)) {
                    $node->removeAttribute($attribute->name);
                }
            }

            if ($tag === 'a') {
                $href = trim($node->getAttribute('href'));

                if (str_contains($href, '{{')
                    || ($href !== '' && ! preg_match('/^(https?:|mailto:|\/|#)/i', $href))) {
                    $node->removeAttribute('href');
                }
            }
        }
    }
}
