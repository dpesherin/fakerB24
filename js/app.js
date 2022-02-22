
$(document).ready(function(){
  $("#fakeUser").on("submit", function(event){
    $("#spinnerUsers").css('display', 'flex')
    event.preventDefault();
      $.ajax({
        url: '../core/fakeusers.php',
        method: 'post',
        dataType: 'html',
        data: $(this).serialize(),
        success: function(data){
          $("#resultUsers").css('display', 'flex')
          $('#resultUsers').html(data);
          $('#usersCount').val("");
          $("#spinnerUsers").css('display', 'none')
          setTimeout(function(){
            $("#resultUsers").css('display', 'none');
          }, 2000);
        }
      });
    });

    $("#fakeCompany").on("submit", function(event){
      $("#spinnerCompanys").css('display', 'flex')
      event.preventDefault();
        $.ajax({
          url: '../core/fakecompanys.php',
          method: 'post',
          dataType: 'html',
          data: $(this).serialize(),
          success: function(data){
            $("#resultCompany").css('display', 'flex')
            $('#resultCompany').html(data);
            $('#companyCount').val("");
            $("#spinnerCompanys").css('display', 'none')
            setTimeout(function(){
              $("#resultCompany").css('display', 'none');
            }, 2000);
          }
        });
      });

      $("#deleteCompanys").click( function(event){
        $("#spinnerCompanys").css('display', 'flex')
        event.preventDefault();
          $.ajax({
            url: '../core/deletecompany.php',
            method: 'post',
            dataType: 'html',
            data: $(this).serialize(),
            success: function(data){
              $("#resultCompany").css('display', 'flex')
              $('#resultCompany').html(data);
              $('#companyCount').val("");
              $("#spinnerCompanys").css('display', 'none')
              setTimeout(function(){
                $("#resultCompany").css('display', 'none');
              }, 2000);
            }
          });
        });

      $("#fakeDeals").on("submit", function(event){
        $("#spinnerDeals").css('display', 'flex')
        event.preventDefault();
          $.ajax({
            url: '../core/fakedeals.php',
            method: 'post',
            dataType: 'html',
            data: $(this).serialize(),
            success: function(data){
              $("#resultDeals").css('display', 'flex')
              $('#resultDeals').html(data);
              $('#dealsCount').val("");
              $('#start').val("");
              $('#end').val("");
              $("#spinnerDeals").css('display', 'none')
              setTimeout(function(){
                $("#resultDeals").css('display', 'none');
              }, 2000);
            }
          });
        });

        $("#deleteDeals").click( function(event){
          $("#spinnerDeals").css('display', 'flex')
          event.preventDefault();
            $.ajax({
              url: '../core/deletedeals.php',
              method: 'post',
              dataType: 'html',
              data: $(this).serialize(),
              success: function(data){
                $("#resultDeals").css('display', 'flex')
                $('#resultDeals').html(data);
                $('#dealsCount').val("");
                $('#start').val("");
                $('#end').val("");
                $("#spinnerDeals").css('display', 'none')
                setTimeout(function(){
                  $("#resultDeals").css('display', 'none');
                }, 2000);
              }
            });
          });
  });