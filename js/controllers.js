function HomeCtrl($scope) {
}

function PeopleCtrl($scope, People) {
	$scope.orderProp = 'personID';
	$scope.showPersonIDColumn = false;
	$scope.showArchivedColumn = false;
	$scope.showArchived = false;
	
	$scope.people = People.query();
}

function PersonDetailCtrl($scope, $routeParams, People) {
	$scope.remote = People.get({personID: $routeParams.personID}, function() {
		
		// make a local copy
		$scope.person = angular.copy($scope.remote);
		
		// check if changes have been made to the local copy
		$scope.isModified = function() {
			return !angular.equals($scope.person, $scope.remote);
		}
	});
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
