function getPointVente(){
    let pvs = "";
    let client = $("#client").val();
    $.ajax({
        url: "/pvs",
        type: "get", 
        data: { 
          clientid: client
        },
        success: function(response) {
          //Do Something
          console.log(response)
        },
        error: function(xhr) {
          //Do Something to handle error
          console.log(xhr)
        }
      });
}