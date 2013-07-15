angular.module('magicchatServices', ['ngResource']).
	factory('People', function($resource){
		return $resource('/resources/people.php',
		{personID:'@personID', firstName:'@firstName', lastName:'@lastName', archived:'@archived'},
		{
			query: {method:'GET', params:{method:'GET',isArray:true}, isArray:true},
			get:   {method:'GET', params:{method:'GET'}
			}
		});
	});
