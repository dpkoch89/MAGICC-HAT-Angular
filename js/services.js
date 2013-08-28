angular.module('magicchatServices', ['ngResource']).
	factory('People', function($resource) {
		return $resource('/api/people/:personID', {personID:'@personID'});
	});
