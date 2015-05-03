
function sayhello() {
   // alert("hello");
}

function doCheckDates() {
   // alert("checking dates");
   d1 = document.getElementById('date1').value;
   d2 = document.getElementById('date2').value;
   
   date1 = new Date(d1);
   date2 = new Date(d2);
   ok = date1<=date2;
   if(!ok) {
       alert('Invalid date range');
   }

    return ok;
}