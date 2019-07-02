<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
<div class="row">
  <div class="col s12">
    <div class="row">
      <div class="input-field col s12">
        <label for="country">Autocomplete</label>
        <input type="text" id="country" class="autocomplete">

      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  //Autocomplete
  $(function() {
    $.ajax({
      type: 'GET',
      url: 'https://restcountries.eu/rest/v2/all?fields=name',
      success: function(response) {
        var countryArray = response;
        var dataCountry = {};
        for (var i = 0; i < countryArray.length; i++) {
          //console.log(countryArray[i].name);
          dataCountry[countryArray[i].name] = countryArray[i].flag; //countryArray[i].flag or null
        }
        $('input.autocomplete').autocomplete({
          data: dataCountry,
          limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
        });
      }
    });
  });
});
</script>