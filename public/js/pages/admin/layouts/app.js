// admin - layouts - app: interaksi halaman ini.

document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.alert-success').forEach(function (alert) {
                setTimeout(function () {
                    if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                        bootstrap.Alert.getOrCreateInstance(alert).close();
                    }
                }, 5000);
            });
        });
