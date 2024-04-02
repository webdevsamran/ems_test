<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'status' => 1,
            'password' => '$2y$12$RKUaFxSf2goEr8vP5nYrbeENpN4snLyBLpL/fvsAFAnnVIvVOdJQK', // Password:- admin
        ]);

        $permissions_array = [
            ['CV User View', 'web', 'Allows user to see/view CV User'],
            ['CV User Create', 'web', 'Allows user to add/create CV User'],
            ['CV User Update', 'web', 'Allows user to edit/update CV User'],
            ['CV User Delete', 'web', 'Allows user to remove/delete CV User'],
            ['CV Skill View', 'web', 'Allows user to see/view CV Skill'],
            ['CV Skill Create', 'web', 'Allows user to add/create CV Skill'],
            ['CV Skill Update', 'web', 'Allows user to edit/update CV Skill'],
            ['CV Skill Delete', 'web', 'Allows user to remove/delete CV Skill'],
            ['CV Type View', 'web', 'Allows user to see/view CV Type'],
            ['CV Type Create', 'web', 'Allows user to add/create CV Type'],
            ['CV Type Update', 'web', 'Allows user to edit/update CV Type'],
            ['CV Type Delete', 'web', 'Allows user to remove/delete CV Type'],
            ['CV Source View', 'web', 'Allows user to see/view CV Source'],
            ['CV Source Create', 'web', 'Allows user to add/create CV Source'],
            ['CV Source Update', 'web', 'Allows user to edit/update CV Source'],
            ['CV Source Delete', 'web', 'Allows user to remove/delete CV Source'],
            ['CV Medium View', 'web', 'Allows user to see/view CV Medium'],
            ['CV Medium Create', 'web', 'Allows user to add/create CV Medium'],
            ['CV Medium Update', 'web', 'Allows user to edit/update CV Medium'],
            ['CV Medium Delete', 'web', 'Allows user to remove/delete CV Medium'],
            ['Auth User View', 'web', 'Allows user to see/view Authorized User'],
            ['Auth User Create', 'web', 'Allows user to add/create Authorized User'],
            ['Auth User Update', 'web', 'Allows user to edit/update Authorized User'],
            ['Auth User Delete', 'web', 'Allows user to remove/delete Authorized User'],
            ['Auth Role View', 'web', 'Allows user to see/view Authorization Roles'],
            ['Auth Role Create', 'web', 'Allows user to add/create Authorization Roles'],
            ['Auth Role Update', 'web', 'Allows user to edit/update Authorization Roles'],
            ['Auth Role Delete', 'web', 'Allows user to remove/delete Authorization Roles'],
            ['Auth Permission View', 'web', 'Allows user to see/view Authorization Permissions'],
            ['Auth Permission Create', 'web', 'Allows user to add/create Authorization Permissions'],
            ['Auth Permission Update', 'web', 'Allows user to edit/update Authorization Permissions'],
            ['Auth Permission Delete', 'web', 'Allows user to remove/delete Authorization Permissions'],
            ['Announcement View', 'web', 'Allows user to see/view Announcement'],
            ['Announcement Create', 'web', 'Allows user to add/create Announcement'],
            ['Announcement Update', 'web', 'Allows user to edit/update Announcement'],
            ['Announcement Delete', 'web', 'Allows user to remove/delete Announcement'],
            ['Leave Category View', 'web', 'Allows user to see/view Leave Category'],
            ['Leave Category Create', 'web', 'Allows user to add/create Leave Category'],
            ['Leave Category Update', 'web', 'Allows user to edit/update Leave Category'],
            ['Leave Category Delete', 'web', 'Allows user to remove/delete Leave Category'],
            ['Leave View', 'web', 'Allows user to see/view Leave'],
            ['Leave Create', 'web', 'Allows user to add/create Leave'],
            ['Leave Update', 'web', 'Allows user to remove/delete Leave'],
            ['Leaves Multiple View', 'web', 'Allows admin to see/view all Leaves'],
            ['Attendance User', 'web', 'Allows users to see/view his/her attendance'],
            ['Attendance Admin', 'web', 'Allows admin to access all Attendances'],
            ['Attendance Month', 'web', 'Allows user to see/view Month\'s Attendance'],
            ['Department View', 'web', 'Allows user to see/view Department'],
            ['Department Create', 'web', 'Allows user to add/create Department'],
            ['Department Update', 'web', 'Allows user to edit/update Department'],
            ['Department Delete', 'web', 'Allows user to remove/delete Department'],
            ['Designation View', 'web', 'Allows user to see/view Designation'],
            ['Designation Create', 'web', 'Allows user to add/create Designation'],
            ['Designation Update', 'web', 'Allows user to edit/update Designation'],
            ['Designation Delete', 'web', 'Allows user to remove/delete Designation'],
            ['Activity View', 'web', 'Allows user to see/view activity'],
            ['Activity Create', 'web', 'Allows user to add/create activity'],
            ['Activity Update', 'web', 'Allows user to edit/update activity'],
            ['Activity Delete', 'web', 'Allows user to remove/delete activity'],
            ['Activity User', 'web', 'Allows user to see/view his/her activity'],
            ['Activity Admin', 'web', 'Allows admin to access all activities'],
            ['Pay Head View', 'web', 'Allows user to see/view Pay Head'],
            ['Pay Head Create', 'web', 'Allows user to add/create Pay Head'],
            ['Pay Head Update', 'web', 'Allows user to edit/update Pay Head'],
            ['Pay Head Delete', 'web', 'Allows user to remove/delete Pay Head'],
            ['Pay Head Formula View', 'web', 'Allows user to see/view Pay Head Formula'],
            ['Pay Head Formula Create', 'web', 'Allows user to add/create Pay Head Formula'],
            ['Pay Head Formula Update', 'web', 'Allows user to edit/update Pay Head Formula'],
            ['Pay Head Formula Delete', 'web', 'Allows user to remove/delete Pay Head Formula'],
            ['Salary Setup View', 'web', 'Allows user to see/view Payment Setup'],
            ['Salary Setup Create', 'web', 'Allows user to add/create Payment Setup'],
            ['Salary Setup Update', 'web', 'Allows user to edit/update Payment Setup'],
            ['Salary Setup Delete', 'web', 'Allows user to remove/delete Payment Setup'],
            ['Project View', 'web', 'Allows user to see/view Project'],
            ['Project Admin', 'web', 'Allows admin to accel all Projects'],
            ['Project Create', 'web', 'Allows user to add/create Project'],
            ['Project Update', 'web', 'Allows user to edit/update Project'],
            ['Project Delete', 'web', 'Allows user to remove/delete Project'],
            ['Project Module View', 'web', 'Allows user to see/view Project Module'],
            ['Project Module Admin', 'web', 'Allows Admin to access all Project Modules'],
            ['Project Module Create', 'web', 'Allows user to add/create Project Module'],
            ['Project Module Update', 'web', 'Allows user to edit/update Project Module'],
            ['Project Module Delete', 'web', 'Allows user to remove/delete Project Module'],
            ['Project Module Contribution View', 'web', 'Allows user to see/view Project Module Contributions'],
            ['Project Module Contribution Admin', 'web', 'Allows admin to access all Project Module Contributions'],
            ['Project Module Contribution Create', 'web', 'Allows user to add/create Project Module Contribution'],
            ['Project Module Contribution Update', 'web', 'Allows user to edit/update Project Module Contribution'],
            ['Project Module Contribution Delete', 'web', 'Allows user to remove/delete Project Module Contribution'],
            ['Pay Slip View', 'web', 'Allows User to see/view Pay Slip'],
            ['Pay Slip Create', 'web', 'Allows you to generate Pay Slips'],
            ['Issue Category View', 'web', 'Allows user to see/view Issue Categories'],
            ['Issue Category Create', 'web', 'Allows user to add/create Issue Category'],
            ['Issue Category Update', 'web', 'Allows user to edit/update Issue Category'],
            ['Issue Category Delete', 'web', 'Allows user to remove/delete Issue Category'],
            ['Issue View', 'web', 'Allows user to see/view Issues'],
            ['Issue Admin', 'web', 'Allows admin to access all Issues'],
            ['Issue Create', 'web', 'Allows user to add/create Issue'],
            ['Issue Update', 'web', 'Allows user to edit/update Issue'],
            ['Issue Delete', 'web', 'Allows user to remove/delete Issue'],
            ['Issue Contribution View', 'web', 'Allows user to see/view Issue Contributions'],
            ['Issue Contribution Admin', 'web', 'Allows admin to access all Issue Contributions'],
            ['Issue Contribution Create', 'web', 'Allows user to add/create Issue Contribution'],
            ['Issue Contribution Update', 'web', 'Allows user to edit/update Issue Contribution'],
            ['Issue Contribution Delete', 'web', 'Allows user to remove/delete Issue Contribution'],
            ['Configuration View', 'web', 'Allows user to see/view Configuration'],
            ['Configuration Create', 'web', 'Allows user to add/create Configuration'],
            ['Configuration Update', 'web', 'Allows user to edit/update Configuration'],
            ['Configuration Delete', 'web', 'Allows user to remove/delete Configuration'],
            ['Projection View', 'web', 'Allows to see/view Projection'],
            ['Projection Create', 'web', 'Allows to add/create Projection']
        ];

        foreach ($permissions_array as $permissionData) {
            Permission::create($permissionData);
        }
    }
}
