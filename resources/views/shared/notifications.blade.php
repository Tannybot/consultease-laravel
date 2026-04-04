<!-- Notifications Panel Component -->
<div class="notification-panel" id="notificationPanel">
    <div class="notification-header">
        <h3>Notifications</h3>
        <span class="close-panel" id="closeNotificationPanel">&times;</span>
    </div>
    <div class="notification-list" id="notificationList">
        <!-- Notifications will be dynamically loaded here by Javascript -->
        <div style="padding:20px; text-align:center; color:#888;">Loading notifications...</div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notifBtn = document.getElementById('notification-btn');
        const notifPanel = document.getElementById('notificationPanel');
        const closeBtn = document.getElementById('closeNotificationPanel');
        const notifList = document.getElementById('notificationList');
        
        // Toggle panel open
        if(notifBtn) {
            notifBtn.addEventListener('click', function() {
                notifPanel.classList.add('open');
                fetchNotifications();
                markAllAsRead();
            });
        }
        
        // Close panel
        if(closeBtn) {
            closeBtn.addEventListener('click', function() {
                notifPanel.classList.remove('open');
            });
        }
        
        function fetchNotifications() {
            fetch('{{ route("notifications.fetch") }}')
                .then(response => response.json())
                .then(data => {
                    if(data.error) {
                        notifList.innerHTML = '<div style="padding:20px; text-align:center; color:red;">Error loading notifications.</div>';
                        return;
                    }
                    
                    if(data.notifications.length === 0) {
                        notifList.innerHTML = '<div style="padding:20px; text-align:center; color:#888;">No new notifications.</div>';
                        return;
                    }
                    
                    let html = '';
                    data.notifications.forEach(notif => {
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
                .catch(error => {
                    console.error('Error fetching notifications:', error);
                    notifList.innerHTML = '<div style="padding:20px; text-align:center; color:red;">Failed to connect to the server.</div>';
                });
        }
        
        function markAllAsRead() {
            fetch('{{ route("notifications.read") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).catch(err => console.error('Error marking read:', err));
        }
    });
</script>
