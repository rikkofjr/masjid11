<div wire:ignore>
    <div id="calendar"></div>
</div>

@push('styles')


@endpush

@push('scripts')
    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>

    <script>
        document.addEventListener('livewire:load', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: @json($events), // ambil data dari Livewire
                eventClick: function(info) {
                    alert('Agenda: ' + info.event.title + "\nWaktu: " + info.event.start.toLocaleString());
                }
            });

            calendar.render();
        });
    </script>
@endpush
