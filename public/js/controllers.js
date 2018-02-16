var taskManagerAppControllers = angular.module('taskManagerAppControllers', []);

taskManagerAppControllers.controller('LoginController', ['$scope', '$http', '$location', 'userService', function ($scope, $http, $location, userService) {

    $scope.login = function () {
        userService.login(
            $scope.email, $scope.password,
            function (response) {
                $location.path('/');
            },
            function (response) {
                alert('Something went wrong with the login process. Try again later!');
            }
        );
    }

    $scope.email = '';
    $scope.password = '';

    if (userService.checkIfLoggedIn())
        $location.path('/');

}]);

taskManagerAppControllers.controller('SignupController', ['$scope', '$http', function ($scope, $http) {

    $scope.signup = function () {
        userService.signup(
            $scope.name, $scope.email, $scope.password,
            function (response) {
                alert('Great! You are now signed in! Welcome, ' + $scope.name + '!');
                $location.path('/');
            },
            function (response) {
                alert('Something went wrong with the signup process. Try again later.');
            }
        );
    }

    $scope.name = '';
    $scope.email = '';
    $scope.password = '';

    if (userService.checkIfLoggedIn())
        $location.path('/');

}]);

taskManagerAppControllers.controller('MainController', ['$scope', '$location', 'userService', 'taskService', function ($scope, $location, userService, taskService) {

    $scope.load = function (taskId) {

        taskService.getById(taskId, function (response) {

            $scope.currentTaskId = response.task.id;
            $scope.currentStartTime = response.task.start_time;
            $scope.currentEndTime = response.task.end_time;
            //$scope.currentBookPagesCount = response.book.pages_count;

            $('#updateTaskModal').modal('toggle');

        }, function () {

            alert('Some errors occurred while communicating with the service. Try again later.');

        });

    }

    $scope.update = function () {

        taskService.update(
            $scope.currentTaskId,
            {
                name: $scope.currentTaskName,
                start_time: $scope.currentStartTime,
                end_time: $scope.currentEndTime
            },
            function (response) {

                $('#updateTaskModal').modal('toggle');
                $scope.currentTaskReset();
                $scope.refresh();

            }, function (response) {
                alert('Some errors occurred while communicating with the service. Try again later.');
            }
        );
    }


    $scope.logout = function () {
        userService.logout();
        $location.path('/login');
    }

    $scope.create = function () {

        taskService.create({
            name: $scope.currentTaskName,
            start_time: $scope.currentStartTime,
            end_time: $scope.currentEndTime
        }, function () {

            $('#addTaskModal').modal('toggle');
            $scope.currentTaskReset();
            $scope.refresh();

        }, function () {

            alert('Some errors occurred while communicating with the service. Try again later.');

        });

    }

    $scope.refresh = function () {

        taskService.getAll(function (response) {

            $scope.tasks = response;

        }, function () {

            alert('Some errors occurred while communicating with the service. Try again later.');

        });

    }

    $scope.remove = function (taskId) {

        if (confirm('Are you sure to remove this task from your wishlist?')) {
            taskService.remove(taskId, function () {

                alert('Task removed successfully.');

            }, function () {

                alert('Some errors occurred while communicating with the service. Try again later.');

            });
        }

    }


    $scope.currentTaskReset = function () {
        $scope.currentTaskName = '';
        $scope.currentStartTime = '';
        $scope.currentEndTime = '';
    }

    if (!userService.checkIfLoggedIn())
        $location.path('/login');

    $scope.tasks = [];

    $scope.refresh();

}]);