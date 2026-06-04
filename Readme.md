# Business scenario :

I want to develop Land Transport Coordination System. currently operating workflow is below : 

User/Customer request the route (with car and driver) to Land Transport Coordinator from email. 
The user can request route for others also. (Like Requesting Transportation for team members.)
if the route can be long or short trip. long trips mean from one city to another. 
the long trip need to request 5 days in advanced. the urgent requests can be done by specific users(like manager roles).
if it's long trip need to assign two drivers for one car for safety.
The Car need to be checked by driver assigned by Land Transport Coordinator if the car is assigned for route.
Sometimes User reject the route request or edit, so The Land TranspAortation coordinator need to check again eventhough its accepted. 

When the route Request started : 

- The Land Transportation Coordinator check the Request, 
    The Land Transportation coordinator check which car or more to assign, one or more drivers to assign based on route. if the route requested is for how many person and check the car capacity, need to assign more cars or one car which can hold enough people. 
    Needs to check which driver to assign, which drivers are free(sometimes ask driver and confirm, check Leave requests), their working hours not exceeding 10hours if exceeded how many overtime left for one week. (maximum 5hours per week)
    If the Driver is pre-requested the leave and accepted before, the Land Transport Coordinator can't assign him if its within leave.
    The drivers can request leave to land transport coordinator. they can edit or delete the request.
    If the driver didn't have accepted leave request, the land transport coordinator map the driver with route. 
    The Land Transport coordinator cannot assign another route to him during the operation. When the driver said the route is completed, they can only reassign him another route. 

- The Land Transport Coordinator need to assign drivers for checking cars daily/weekly/monthly. the check list is given to drivers for each cars. The Land Transport Coordinator need to update daily sheet for routes fuel consumption, total (km), for the cars - daily checking status, last fuel refil time, litre, total distance, estimated fuel consumption. drivers total leave available, leave taken, leave type, leave hours.

# Business Understanding 
## Business Discovery 
### State holder Identification
**Person involved in system**
    <table>
        <tr>
        <th>Stakeholder</th>
        <th>Role</th>
        </tr>        
        <tr>
        <td>manager roles</td>
        <td>Request Transportations, cancel Transportation Request, can request Daily Operation Requests,can Request transportations for delivering load,can request round trip,a transportation request can includes routes. can request ferry for themselves and also others.</td>
        </tr>
        <tr>
        <td>staffs</td>
        <td>Can view Transportation request they are tagged. (Like CC in mail, they are included in mail if they are included for transportation.) cannot request transportation. they can request ferry for themselves.
        </td>
        </tr>
        <tr>
        <td>Land Transport Coordinator(can assume as admin role with operation permissions.)</td>
        <td>Manage Operations :
        For custom transportation request:
        <ul>
        <li> View Transportation Request, Accept or Reject Transportation Request</li>
        <li> Assign available Drivers,Cars for Transportation Request</li>
        <li> Manage Daily Operations(this is also assigning drivers and cars.)</li>
        <li> Producing Checklists for Cars (daily,Weekly,Urgent)  </li>
        <li> Assigning Fleet Admin for checking one or more cars(daily,urgent,weekly)</li>
        <li> Always report transport KPI Report, Journey Log Report for audit/review purpose</li>
        </ul>
        For Ferry Transportation: 
        - Need to create routes for ferrys. 
        - Need to edit routes for new requests. 
        - Need to reassign driver if current assigned driver took leave. 
        - there are still cases like temporary stopping one of the Ferry services.
        </td>
        </tr>
        <tr>
        <td>Fleet Admin</td>
        <td>Daily Vehicles Examinations. Urgent Vehicles Examinations. Before and After Transportation checking, Reporting Vehicle conditions to Land Transport coordinator.</td>
        </tr>
        <tr>
        <td>Drivers</td>
        <td>drivers can view transportations they are assigned. drivers can request leave through leave form. if there is a transportation assigned for leave day range, the other driver need to reassign or reject the leave request. need to report if there is any anomalies or incidents.
        </td>
        </tr>
    </table>

### Business Rules

### Transportation Rules. 
Long Trips require 5days advanced request. 
Long trips need at least two drivers per car. 
Car capacity must match passenger count, if not need to add more cars.

### Driver Rules

Driver max working hours = 10 hours/day
Max overtime = 5 hours/week
Cannot be assigned if leave overlaps route schedule
Only one active assignment at a time

### Reassignment Rules
If request is edited/rejected → ALL assignments reset
If driver/car changes → coordinator must re-validate

### Fleet Rules
Vehicle must be inspected before assignment
Checklist must be completed per schedule (daily/weekly/urgent)

### Route Requested Life cycle. 

Requested -> Under Review -approved-> assigned -> in progress -> Completed
                |
                |__Rejected-> Reason

Driver Assignment Workflow 

Available -> Checked -> On Trip -> Released -> Available.

Vehicle Flow
Available → Inspected → Assigned → In Use → Returned → Maintenance Check

### Driver Leave Workflow


Drafted-> Submitted -> Pending ->  Approved
                        |________> Rejected


# Domain Models 
## Transportation Request
Request ID
Requestor
Passengers
Pickup Point
Destination
Require Arrival time
Trip Date
Trip Type
Status
Description

## Routes
Route ID
Latitude
Longtitude
arrival time

## Employees
Employee id 
Employee Name
Role
Address
Phone Number

## Drivers
Driver ID 
Driver Name
License 
Status
Address
Phone Number

## Vehicles
Vehicle Number
Car Model
Color
Capacity
Status
Fuel Consumption
Current Mileage

## Leaves
Leave ID
Leave Type
Total allow Leave


## 4. Tech Stack
*   **Backend:** Laravel (PHP)
*   **Frontend:** React, React Query, Tailwind CSS
*   **Database:** PostgreSQL
*   **Deployment:** Docker

---

## 5. Implementation Roadmap
- [x] Business Discovery & Rules Definition
- [x] Workflow & Process Modeling
- [x] Domain Model Design
- [ ] Database Schema (ERD) & Migration Planning
- [ ] API Architecture Design
- [ ] UI/UX Prototyping
- [ ] Core Development
- [ ] Testing & Validation (KPI Reporting)



