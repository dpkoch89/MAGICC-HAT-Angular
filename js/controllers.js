function HomeCtrl($scope) {
}

function PeopleCtrl($scope, People) {
	$scope.orderProp = 'personID';
	$scope.showPersonIDColumn = false;
	$scope.showArchivedColumn = false;
	$scope.showArchived = false;
	
	$scope.people = People.query();
}

function PersonDetailCtrl($scope, $location, $routeParams, People) {
	$scope.remote = People.get({personID: $routeParams.personID}, function() {
		
		// make a local copy
		$scope.person = angular.copy($scope.remote);
		
		// check if changes have been made to the local copy
		$scope.isModified = function() {
			return !angular.equals($scope.person, $scope.remote);
		}
		
		// save changes
		$scope.save = function() {
		  $scope.remote = angular.copy($scope.person);
		  $scope.remote.$update();
		  $location.path('/people');
		}
	});
}

function PersonCreateCtrl($scope, $location, People) {
  $scope.isModified = function() {
    return true;
  }
  
  $scope.save = function() {
    People.create($scope.person, function() {
      $location.path('/people');
    });
  }
}

function ItemsCtrl($scope, $http) {
	$http.get('/tables/items_table.php').success(function (data) {
		$scope.items = data;
	});
	
	$scope.orderProp = 'itemID';
}

function ItemDetailCtrl($scope, $routeParams) {
	$scope.itemID = $routeParams.itemID;
}
