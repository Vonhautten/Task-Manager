document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    // Fetch events dari database
    fetch('halaman/kalender/fetch-events.php')
        .then((response) => response.json())
        .then((events) => {
            // Inisialisasi FullCalendar
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                },
                events: events, // Ambil data events dari fetch
                eventContent: function (arg) {
                    // Hanya menampilkan nama tugas tanpa waktu
                    return {
                        html: `<div class="event-title">${arg.event.title}</div>`
                    };
                },
                dateClick: function (info) {
                    alert(`Tanggal yang Anda klik: ${info.dateStr}`);
                },
                eventClick: function (info) {
                    // Tampilkan nama tugas dan waktu detail saat event diklik
                    const eventTitle = info.event.title; // Nama tugas
                    const eventTime = info.event.start.toLocaleString(); // Waktu dalam format lokal
                    alert(`Tugas: ${eventTitle}\nWaktu: ${eventTime}`);
                },
            });

            calendar.render();
        })
        .catch((error) => {
            console.error('Error fetching events:', error);
        });
});
