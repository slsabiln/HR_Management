<?php

it('has employeesalary page', function () {
    $response = $this->get('/employeesalary');

    $response->assertStatus(200);
});
