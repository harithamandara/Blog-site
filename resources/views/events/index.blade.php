<x-app-layout>
    <!-- Include necessary CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for event body */
        .event-body {
            background-color: orange;
            color: white;
            padding: 5px;
        }

        #calendar {
            width: 100%;
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mb-3">
                <select id="departmentFilter" class="form-select">
                    <option value="">Select Department</option>
                    <option value="1">Department 1</option>
                    <option value="2">Department 2</option>
                    <option value="3">Department 3</option>
                </select>
                <select id="yearFilter" class="form-select">
                    <option value="">Select Academic Year</option>
                    <option value="1">Year 1</option>
                    <option value="2">Year 2</option>
                    <option value="3">Year 3</option>
                </select>
            </div>
            <div class="col-md-8">
                <h2 class="text-center">Event Calendar</h2>
                <div id="calendar"></div>
            </div>
            <div class="col-md-4">
                <h4>Events on Selected Day</h4>
                <div id="event-list" class="list-group">
                    <!-- Event details will be listed here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Include necessary scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var events = @json($events); // Assume this brings the initial array of events.

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events.map(function(event) {
                    return {
                        title: event.title,
                        start: event.published_at,
                        allDay: true,
                        extendedProps: {
                            body: event.body,
                            department_id: event.department_id,
                            academic_year: event.academic_year
                        }
                    };
                }),
                eventClick: function(info) {
                    var eventDetails = document.getElementById('event-list');
                    eventDetails.innerHTML = `
                        <h5>${info.event.title}</h5>
                        <p><strong>Event Details:</strong> ${info.event.extendedProps.body}</p>
                        <p><strong>Department:</strong> ${info.event.extendedProps.department_id}</p>
                        <p><strong>Academic Year:</strong> ${info.event.extendedProps.academic_year}</p>
                    `;
                },
                eventDidMount: function(info) {
                    var bodyEl = document.createElement('div');
                    bodyEl.classList.add('event-body');
                    bodyEl.innerHTML = `${info.event.extendedProps.body} (Dept: ${info.event.extendedProps.department_id}, Year: ${info.event.extendedProps.academic_year})`;
                    info.el.appendChild(bodyEl);
                },
            });

            calendar.render();
        });

    </script>
</x-app-layout>
