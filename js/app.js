angular.module('magicchat', ['magicchatServices']).
	config(['$routeProvider', function($routeProvider) {
		$routeProvider.
			when('/', {templateUrl: 'partials/home.html', controller: HomeCtrl}).
			when('/people', {templateUrl: 'partials/people.html', controller: PeopleCtrl}).
			when('/people/:personID', {templateUrl: 'partials/person-detail.html', controller: PersonDetailCtrl}).
			when('/items', {templateUrl: 'partials/items.html', controller: ItemsCtrl}).
			when('/items/:itemID', {templateUrl: 'partials/item-detail.html', controller: ItemDetailCtrl}).
			otherwise({redirectTo: '/'});
	}])
