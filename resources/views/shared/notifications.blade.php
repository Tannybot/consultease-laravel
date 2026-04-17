<div class="notification-panel" id="notificationPanel" aria-hidden="true">
    <div class="notification-header">
        <h3>Notifications</h3>
        <button type="button" class="close-panel" id="closeNotificationPanel" aria-label="Close notifications">&times;</button>
    </div>
    <div class="notification-list" id="notificationList">
        <div class="empty-state" style="padding: 24px 12px;">
            <p>Loading notifications...</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notifBtn = document.getElementById('notification-btn');
        const notifPanel = document.getElementById('notificationPanel');
        const closeBtn = document.getElementById('closeNotificationPanel');
        const notifList = document.getElementById('notificationList');

        function setPanelState(isOpen) {
            if (!notifPanel) {
                return;
            }

            notifPanel.classList.toggle('open', isOpen);
            notifPanel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
        }

        if (notifBtn) {
            notifBtn.addEventListener('click', function () {
                setPanelState(true);
                fetchNotifications();
                markAllAsRead();
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                setPanelState(false);
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                setPanelState(false);
            }
        });

        function renderMessage(message, tone) {
            const toneClass = tone === 'error' ? 'status-banner status-banner--error' : '';
            notifList.innerHTML = '<div class="' + toneClass + '" style="margin: 6px;">' + message + '</div>';
        }

        function fetchNotifications() {
            fetch('{{ route("notifications.fetch") }}')
                .then(function (response) { return response.json(); })
                .then(function (data) {
                    if (data.error) {
                        renderMessage('Error loading notifications.', 'error');
                        return;
                    }

                    if (data.notifications.length === 0) {
                        notifList.innerHTML = '<div class="empty-state"><p>No new notifications.</p></div>';
                        return;
                    }

                    let html = '';

                    data.notifications.forEach(function (notif) {
                        const date = new Date(notif.created_at).toLocaleString();
                        const unreadClass = notif.is_read ? '' : 'unread';

                        html += `
                            <div class="notification-item ${unreadClass}" onclick="this.classList.toggle('expanded')">
                                <div class="summary">${notif.title}</div>
                                <div class="time">${date}</div>
                                <div class="details">${notif.message}</div>
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
