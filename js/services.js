angular.module('magicchatServices', ['ngResource']).
	factory('People', function($resource) {
		return $resource('/api/people/:personID', {personID:'@personID'}, {
		  create: {method:'POST', url:'/api/people'},
		  update: {method:'PUT'}
		});
	});
