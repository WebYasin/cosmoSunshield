
$('#Login_Form').submit(function(e){
var base = $('#base').data('base');
var form = $(this);
e.preventDefault();
$.ajax({
  url: base + 'admin_console/verify_',
  type:"POST",
  data:form.serialize(),
  success:function(data){ 
    var obj =JSON.parse(data);
    if (obj.status==1) {

       toastr.success(obj.msg);
       window.location.href=obj.link;
        
    }else{
      var set_v ='';
      if (obj.username) {
        set_v = obj.username;
      }
      if (obj.password) {
        set_v = obj.password;
      }
      if (obj.msg) {
        set_v = obj.msg;
      }
    toastr.error(set_v);

    }
  },
  
 });
});

