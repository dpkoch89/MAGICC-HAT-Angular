angular.module('magicchatFilters', []).

  filter('showArchivedRecords', function() {
    return function (records, showArchived) {
      var items = {
        showArchived: showArchived,
        out: []
      };
      
      angular.forEach(records, function (value, key) {
        if (value.archived == false || this.showArchived == true)
        {
          this.out.push(value);
        }
      }, items);
      
      return items.out;
    };
  }).
  
  filter('boolToAlpha', function() {
    return function (input) {
      return (input == 0) ? 'false' : 'true';
    }
  });
