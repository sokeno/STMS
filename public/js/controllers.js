var taskManagerAppControllers = angular.module('taskManagerAppControllers', [
    'taskManagerAppServices'
]);

taskManagerAppControllers.controller('LoginController', ['$scope', '$location', 'userService', function ($scope, $location, userService) {

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

taskManagerAppControllers.controller('SignupController', ['$scope', '$location', 'userService', function ($scope, $location, userService) {

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

    $scope.logout = function () {
        userService.logout();
        $location.path('/login');
    }

    $scope.create = function () {

        taskService.create({
            name: $scope.currentTaskName,
            start_time: $scope.currentTaskStartTime,
            end_time: $scope.currentTaskEndTime
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

    $scope.load = function (taskId) {

        taskService.getById(taskId, function (response) {

            $scope.currentTaskId = this.id;
            $scope.currentTaskName = this.name;
            $scope.currentTaskStartTime = this.start_time;
            $scope.currentTaskEndTime = this.end_time;
            //response.task.end_time;

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
                start_time: $scope.currentTaskStartTime,
                end_time: $scope.currentTaskEndTime
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
        $scope.currentTaskStartTime = '';
        $scope.currentTaskEndTime = '';
        $scope.currentTaskId = '';
    }

    if (!userService.checkIfLoggedIn())
        $location.path('/login');

    $scope.tasks = [];

    $scope.currentTaskReset();
    $scope.refresh();

}]);