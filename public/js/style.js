
$(function(){
  $('.nav-item a').filter(function(){
    var a = this.href;
    var b = location.href;
    var c = b.indexOf(a);
    if(c == -1){
      return false;
    }else{
      return true;
    }
  }).addClass('active').siblings().removeClass('active');
});


$(document).ready(function(){
  let row_number = 1;
  $("#add_row").click(function(e){
    e.preventDefault();
    let new_row_number = row_number - 1;
    $('#food' + row_number).html($('#food' + new_row_number).html());
    $('#foods_table').append('<tr id="food' + (row_number + 1) + '"></tr>');
    row_number++;
  });

  $("#delete_row").click(function(e){
    e.preventDefault();
    if(row_number > 1){
      $("#food" + (row_number - 1)).html('');
      row_number--;
    }
  });
});
function showTime(){
  var date = new Date();
  var h = date.getHours(); // 0 - 23
  var m = date.getMinutes(); // 0 - 59
  var s = date.getSeconds(); // 0 - 59
  var session = "AM";
  
  if(h == 0){
      h = 12;
  }
  
  if(h > 12){
      h = h - 12;
      session = "PM";
  }
  
  h = (h < 10) ? "0" + h : h;
  m = (m < 10) ? "0" + m : m;
  s = (s < 10) ? "0" + s : s;
  
  var time = h + ":" + m + ":" + s + " " + session;
  document.getElementById("MyClockDisplay").innerText = time;
  document.getElementById("MyClockDisplay").textContent = time;
  
  setTimeout(showTime, 1000);
  
}

showTime();
var popover = new bootstrap.Popover(document.querySelector('.popover-dismiss'), {
  trigger: 'focus'
})