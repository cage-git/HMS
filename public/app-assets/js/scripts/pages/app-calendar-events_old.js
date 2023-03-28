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
// const events = [];
// $.ajax({
//       url: base_url + 'api/get-calendar-events',
//       data: {month: new Date().getMonth()+1, year: new Date().getFullYear()},
//       type: 'POST',
//       dataType: "json",
//       headers: {
//           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
//       },
//       success: function (result) {
//         // Get requested calendars as Array
//         console.log("result", result);
//         events = [...events, ...result.events];
//       },
//       error: function (error) {
//         console.log(error);
//       }
//       // beforeSend: b_send,
//       // success: success,
//       // error: error,
//       // complete: complete
//   });
// console.log("new events array", events);

// var events = [
//   {
//     id: 1,
//     url: '',
//     title: 'test Design Review',
//     start: '2023-03-26T01:00:00+05:30',
//     end: '2023-03-28T01:00:00+05:30',
//     allDay: false,
//     extendedProps: {
//       calendar: 'Business'
//     }
//   },
//   {
//     id: 2,
//     url: '',
//     title: 'Meeting With Client',
//     start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
//     end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
//     allDay: true,
//     extendedProps: {
//       calendar: 'Business'
//     }
//   },
//   {
//     id: 3,
//     url: '',
//     title: 'Family Trip',
//     allDay: true,
//     start: new Date(date.getFullYear(), date.getMonth() + 1, -9),
//     end: new Date(date.getFullYear(), date.getMonth() + 1, -7),
//     extendedProps: {
//       calendar: 'Holiday'
//     }
//   },
//   {
//     id: 4,
//     url: '',
//     title: "Doctor's Appointment",
//     start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
//     end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
//     allDay: true,
//     extendedProps: {
//       calendar: 'Personal'
//     }
//   },
//   {
//     id: 5,
//     url: '',
//     title: 'Dart Game?',
//     start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
//     end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
//     allDay: true,
//     extendedProps: {
//       calendar: 'ETC'
//     }
//   },
//   {
//     id: 6,
//     url: '',
//     title: 'Meditation',
//     start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
//     end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
//     allDay: true,
//     extendedProps: {
//       calendar: 'Personal'
//     }
//   },
//   {
//     id: 7,
//     url: '',
//     title: 'Dinner',
//     start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
//     end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
//     allDay: true,
//     extendedProps: {
//       calendar: 'Family'
//     }
//   },
//   {
//     id: 8,
//     url: '',
//     title: 'Product Review',
//     start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
//     end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
//     allDay: true,
//     extendedProps: {
//       calendar: 'Business'
//     }
//   },
//   {
//     id: 9,
//     url: '',
//     title: 'Monthly Meeting',
//     start: nextMonth,
//     end: nextMonth,
//     allDay: true,
//     extendedProps: {
//       calendar: 'Business'
//     }
//   },
//   {
//     id: 10,
//     url: '',
//     title: 'Monthly Checkup',
//     start: prevMonth,
//     end: prevMonth,
//     allDay: true,
//     extendedProps: {
//       calendar: 'Personal'
//     }
//   }
// ];
