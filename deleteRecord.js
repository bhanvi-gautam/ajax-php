
$(document).on("click","#delete",function(){
    if(confirm("Do you want to delete this record?")){
        //var element=this;
        console.log('hereee'); return;
        $ajax({
            url:"deleteRecord_form.php",
            type:"POST",
            data:{deleteId:25},
            success: function(data){
                if(data="YES"){
                    //$element.fadeOut().remove();
                }else{
                   // alert("can't delete the  row")
                }
                
            }

        });
    }
});
