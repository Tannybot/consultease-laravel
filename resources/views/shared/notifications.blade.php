<div class="notification-backdrop" id="notificationBackdrop" aria-hidden="true"></div>

<div class="notification-panel" id="notificationPanel" aria-hidden="true" aria-labelledby="notificationPanelTitle">
    <div class="notification-header">
        <h3 id="notificationPanelTitle">Notifications</h3>
        <button type="button" class="close-panel" id="closeNotificationPanel" aria-label="Close notifications">&times;</button>
    </div>
    <div class="notification-list" id="notificationList">
        <div class="notification-state">
            <p>Notifications will appear here.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notifBtn = document.getElementById('notification-btn');
        const notifPanel = document.getElementById('notificationPanel');
        const notifBackdrop = document.getElementById('notificationBackdrop');
        const closeBtn = document.getElementById('closeNotificationPanel');
        const notifList = document.getElementById('notificationList');

        function setPanelState(isOpen) {
            if (!notifPanel) {
                return;
            }

            notifPanel.classList.toggle('open', isOpen);
            notifPanel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            document.body.classList.toggle('notification-open', isOpen);

            if (notifBackdrop) {
                notifBackdrop.classList.toggle('open', isOpen);
                notifBackdrop.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            }
        }

        window.setNotificationPanelState = setPanelState;

        function escapeHtml(value) {
            const div = document.createElement('div');
            div.textContent = value || '';
            return div.innerHTML;
        }

        function renderMessage(message, tone) {
            const toneClass = tone === 'error'
                ? 'notification-state notification-state--error'
                : 'notification-state';

            notifList.innerHTML = '<div class="' + toneClass + '"><p>' + escapeHtml(message) + '</p></div>';
        }

        function formatDate(value) {
            const parsedDate = value ? new Date(value) : null;

            if (!parsedDate || Number.isNaN(parsedDate.getTime())) {
                return 'Unknown time';
            }

            return parsedDate.toLocaleString();
        }

        if (notifBtn) {
            notifBtn.addEventListener('click', function () {
                const willOpen = !notifPanel.classList.contains('open');

                if (willOpen && typeof window.toggleMenu === 'function') {
                    window.toggleMenu(false);
                }

                setPanelState(willOpen);

                if (willOpen) {
                    fetchNotifications();
                    markAllAsRead();
                }
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                setPanelState(false);
            });
        }

        if (notifBackdrop) {
            notifBackdrop.addEventListener('click', function () {
                setPanelState(false);
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                setPanelState(false);
            }
        });

        notifList.addEventListener('click', function (event) {
            const item = event.target.closest('.notification-item');

            if (!item) {
                return;
            }

            const isExpanded = item.classList.toggle('expanded');
            item.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        });

        notifList.addEventListener('keydown', function (event) {
            if (event.key !== 'Enter' && event.key !== ' ') {
                return;
            }

            const item = event.target.closest('.notification-item');

            if (!item) {
                return;
            }

            event.preventDefault();
            const isExpanded = item.classList.toggle('expanded');
            item.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        });

        function fetchNotifications() {
            renderMessage('Loading notifications...');

            fetch('{{ route("notifications.fetch") }}')
                .then(function (response) { return response.json(); })
                .then(function (data) {
                    if (data.error) {
                        renderMessage('Error loading notifications.', 'error');
                        return;
                    }

                    if (data.notifications.length === 0) {
                        notifList.innerHTML = '<div class="notification-state"><p>No new notifications.</p></div>';
                        return;
                    }

                    let html = '';

                    data.notifications.forEach(function (notif) {
                        const date = formatDate(notif.created_at);
                        const unreadClass = notif.is_read ? '' : 'unread';
                        const title = escapeHtml(notif.title || 'Notification');
                        const details = escapeHtml(notif.message || 'No additional details provided.');

                        html += `
                            <div class="notification-item ${unreadClass}" tabindex="0" role="button" aria-expanded="false">
                                <div class="summary">${title}</div>
                                <div class="time">${date}</div>
                                <div class="details">${details}</div>
                            </div>
                        `;
                    });

                    notifList.innerHTML = html;
                })
                .catch(function () {
                    renderMessage('Failed to connect to the server.', 'error');
                });
        }

        function markAllAsRead() {
            fetch('{{ route("notifications.read") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).catch(function (error) {
                console.error('Error marking notifications as read:', error);
            });
        }
    });
</script>
