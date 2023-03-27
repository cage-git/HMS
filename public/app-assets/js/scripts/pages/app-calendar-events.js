/**
 * App Calendar Events
 */

'use strict';

var date = new Date();
var nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
var nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
var prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);


// // console.log("calendar info", date, nextDay, nextMonth, prevMonth);
// // getCalendarEvents();
// if(globalVar.page=='dashboard_page'){
//   console.log("dashboard cal")
//   globalVar.calendar = null;
//   globalVar.calendarEl = null;
//   globalVar.currDate = new Date();
//   globalVar.cdate = new Date();
//   function getDatesObj(){
//     if(globalVar.calendar){
//       globalVar.cdate = globalVar.calendar.getDate();
//     }
//     return { month: globalVar.cdate.getMonth()+1, year: globalVar.cdate.getFullYear() }
//   }
//   function getCalendarEvents(){
//       const dateObj = getDatesObj();
//       const post_data={month: dateObj.month, year: dateObj.year};
//       globalFunc.ajaxCall('api/get-calendar-events', post_data, 'POST', globalFunc.before, globalFunc.successEvents, globalFunc.error, globalFunc.complete);
//   }
//   globalFunc.successEvents=function(data){
// //     if(globalVar.calendarEl){
// //       globalVar.calendarNew  = document.getElementById('calendar');
// //       // eventToUpdate,
// //       // sidebar = $('.event-sidebar'),
// //       // calendarsColor = {
// //       //   Business: 'primary',
// //       //   Holiday: 'success',
// //       //   Personal: 'danger',
// //       //   Family: 'warning',
// //       //   ETC: 'info'
// //       // },
// //       // eventForm = $('.event-form'),
// //       // addEventBtn = $('.add-event-btn'),
// //       // cancelBtn = $('.btn-cancel'),
// //       // updateEventBtn = $('.update-event-btn'),
// //       // toggleSidebarBtn = $('.btn-toggle-sidebar'),
// //       // eventTitle = $('#title'),
// //       // eventLabel = $('#select-label'),
// //       // startDate = $('#start-date'),
// //       // endDate = $('#end-date'),
// //       // eventUrl = $('#event-url'),
// //       // eventGuests = $('#event-guests'),
// //       // eventLocation = $('#event-location'),
// //       // allDaySwitch = $('.allDay-switch'),
// //       // selectAll = $('.select-all'),
// //       // calEventFilter = $('.calendar-events-filter'),
// //       // filterInput = $('.input-filter'),
// //       // btnDeleteEvent = $('.btn-delete-event'),
// //       // calendarEditor = $('#event-description-editor');

// //       // // --------------------------------------------
// //       // // On add new item, clear sidebar-right field fields
// //       // // --------------------------------------------
// //       // $('.add-event button').on('click', function (e) {
// //       //   $('.event-sidebar').addClass('show');
// //       //   $('.sidebar-left').removeClass('show');
// //       //   $('.app-calendar .body-content-overlay').addClass('show');
// //       // });
// //         globalVar.calendar = new FullCalendar.Calendar(globalVar.calendarNew, {
// //           timeZone: globalVar.timezone,
// //           locale: globalVar.locale,
// //           initialDate: globalVar.cdate,
// //           editable: false,
// //           selectable: true,
// //           businessHours: false,
// //           displayEventTime : false,
// //           dayMaxEvents: true,
// //           aspectRatio: 1.50,
// //           headerToolbar: {
// //             left: 'dayGridMonth,'
// //                 // +
// //                 // 'timeGridMonth,' +
// //                 // 'dayGridWeek,' +
// //                 // 'timeGridWeek,' +
// //                 // 'dayGridDay,' +
// //                 // 'list'
// //               ,
// //                 // 'timeGridDay',
// //             center: 'title',
// //             right: 'prev next',
// //           },
// //           events: data.events,
// //           eventClick: function(info) {
// //             console.log('Event: ', info.event, 'Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY, 'View: ' + info.view.type);
// //           }
// //         });
// //         // globalVar.calendar.render();

// //     }
// //   }
// //   $(document).ready(function(){
// //     globalVar.calendarEl = document.getElementById('calendar');
// //     getCalendarEvents('current');
// //   });
// //   $(document).on('click', '.fc-prev-button', function() {
// //     const m1 = globalVar.currDate.getMonth()+1;
// //     const m2 = globalVar.cdate.getMonth()+1;
// //     getCalendarEvents('prev');
// //   });
// //   $(document).on('click', '.fc-next-button', function() {
// //     getCalendarEvents('next');
// //   });
// // }

// var events = db_event;
function getDatesObj(){
  if(globalVar.calendar){
    globalVar.cdate = globalVar.calendar.getDate();
  }
  return { month: globalVar.cdate.getMonth()+1, year: globalVar.cdate.getFullYear() }
}
function getCalendarEvents(){
    const dateObj = getDatesObj();
    const post_data={month: dateObj.month, year: dateObj.year};
    globalFunc.ajaxCall('api/get-calendar-events', post_data, 'POST', globalFunc.before, globalFunc.successEvents, globalFunc.error, globalFunc.complete);
  console.log("requested");
  }
var events = [];
globalFunc.successEvents=function(data){
  console.log("ajax response", data)
  events.push(data.events);
}


// var events = [
//   {
//     getCalendarEventsByDate: 1,
//     url: 'http://hms.test/admin/dashboard',
//     title: 'Design Review',
//     start: date,
//     end: nextDay,
//     allDay: false,
//     extendedProps: {
//       calendar: 'Business'
//     }
//   },
//   {
//     id: 2,
//     url: '',
//     title: 'Tomorrow event',
//     start: date,
//     end: nextDay,
//     allDay: false,
//     extendedProps: {
//       calendar: 'Business'
//     }
//   },

//   // {
//   //   id: 2,
//   //   url: '',
//   //   title: 'Meeting With Client',
//   //   start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
//   //   end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
//   //   allDay: true,
//   //   extendedProps: {
//   //     calendar: 'Business'
//   //   }
//   // },
//   // {
//   //   id: 3,
//   //   url: '',
//   //   title: 'Family Trip',
//   //   allDay: true,
//   //   start: new Date(date.getFullYear(), date.getMonth() + 1, -9),
//   //   end: new Date(date.getFullYear(), date.getMonth() + 1, -7),
//   //   extendedProps: {
//   //     calendar: 'Holiday'
//   //   }
//   // },
//   // {
//   //   id: 4,
//   //   url: '',
//   //   title: "Doctor's Appointment",
//   //   start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
//   //   end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
//   //   allDay: true,
//   //   extendedProps: {
//   //     calendar: 'Personal'
//   //   }
//   // },
//   // {
//   //   id: 5,
//   //   url: '',
//   //   title: 'Dart Game?',
//   //   start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
//   //   end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
//   //   allDay: true,
//   //   extendedProps: {
//   //     calendar: 'ETC'
//   //   }
//   // },
//   // {
//   //   id: 6,
//   //   url: '',
//   //   title: 'Meditation',
//   //   start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
//   //   end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
//   //   allDay: true,
//   //   extendedProps: {
//   //     calendar: 'Personal'
//   //   }
//   // },
//   // {
//   //   id: 7,
//   //   url: '',
//   //   title: 'Dinner',
//   //   start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
//   //   end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
//   //   allDay: true,
//   //   extendedProps: {
//   //     calendar: 'Family'
//   //   }
//   // },
//   // {
//   //   id: 8,
//   //   url: '',
//   //   title: 'Product Review',
//   //   start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
//   //   end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
//   //   allDay: true,
//   //   extendedProps: {
//   //     calendar: 'Business'
//   //   }
//   // },
//   // {
//   //   id: 9,
//   //   url: '',
//   //   title: 'Monthly Meeting',
//   //   start: nextMonth,
//   //   end: nextMonth,
//   //   allDay: true,
//   //   extendedProps: {
//   //     calendar: 'Business'
//   //   }
//   // },
//   // {
//   //   id: 10,
//   //   url: '',
//   //   title: 'Monthly Checkup',
//   //   start: prevMonth,
//   //   end: prevMonth,
//   //   allDay: true,
//   //   extendedProps: {
//   //     calendar: 'Personal'
//   //   }
//   // }
// ];
console.log(events, "front end events");
