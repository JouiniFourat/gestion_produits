function getPointVente(){
    let client = $("#client").val();
    $.ajax({
        url: "/pvs",
        type: "get", 
        data: { 
          clientid: client
        },
        success: function(data) {
          //create the option items
          let obj = JSON.parse(data['resp']);
          let pvs = "";
          pvs += "<option value=''>Toutes les points de vente</option>";          
          for (let pv of obj){
            console.log(pv);
            pvs += "<option value='"+pv['id']+"'>"+pv["full_name"]+"</option>";
          }
          $("#point_vente").html(pvs);
        },
        error: function(xhr) {
          //Do Something to handle error
          console.log(xhr)
        }
      });
}