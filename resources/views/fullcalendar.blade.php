<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='https://unpkg.com/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://unpkg.com/fullcalendar@5.11.3/main.min.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var today = new Date().toISOString().slice(0, 10); // ดึงวันที่ในรูปแบบ 'YYYY-MM-DD'

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listMonth'
        //right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      initialDate: today, // ใช้วันที่ปัจจุบันเป็นค่าเริ่มต้น
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      selectable: true,
      events: [
        {
          title: 'Business Lunch',
          start: '2024-08-03T13:00:00',
          constraint: 'businessHours'
        },
        {
          title: 'Meeting',
          start: '2024-08-13T11:00:00',
          constraint: 'availableForMeeting', // defined below
          color: '#257e4a'
        },
        {
          title: 'Conference',
          start: '2024-08-18',
          end: '2024-08-20'
        },
        {
          groupId: 'availableForMeeting',
          
          title: 'kuy',
          start: '2024-08-18',
          end: '2024-08-18'
        },
        {
          title: 'Party',
          start: '2024-08-29T20:00:00'
        },

        // areas where "Meeting" must be dropped
        {
          groupId: 'availableForMeeting',
          start: '2024-08-11T10:00:00',
          end: '2024-08-11T16:00:00',
          display: 'ff9f89'   //เปลี่ยนจาก bg->rgb แล้วงง
        },
        {
          groupId: 'availableForMeeting',
          start: '2024-08-13T10:00:00',
          end: '2024-08-13T16:00:00',
          display: 'background'
        },

        // red areas where no events can be dropped
        {
          start: '2024-08-24',
          end: '2024-08-28',
          overlap: false,
          display: 'background',
          color: '#ff9f89'
        },
        {
          start: '2024-08-06',
          end: '2024-08-09',   //ไม่ตรงกับหน้า display
          overlap: false,
          display: 'background',
          color: '#ff9f87'
        }
      ]
    });

    calendar.render();
  });
</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }
  
</style>
</head>
<body>

  <div id='calendar'></div>

</body>
</html>
