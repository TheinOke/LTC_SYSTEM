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

Transportation Rules. 
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

## 

Workflows

Transportation request workflow 
%3CmxGraphModel%3E%3Croot%3E%3CmxCell%20id%3D%220%22%2F%3E%3CmxCell%20id%3D%221%22%20parent%3D%220%22%2F%3E%3CmxCell%20id%3D%222%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Submit%20Transportation%20Request%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%222050%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%223%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Request%20Processing%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%222180%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%224%22%20parent%3D%221%22%20style%3D%22rhombus%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Request%20Approved%3F%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%22100%22%20width%3D%22180%22%20x%3D%22590%22%20y%3D%222300%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%225%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23f8cecc%3B%22%20value%3D%22Request%20Rejected%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22160%22%20x%3D%22300%22%20y%3D%222420%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%226%22%20parent%3D%221%22%20style%3D%22rhombus%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Distance%20%26gt%3B%20500km%3F%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%22100%22%20width%3D%22180%22%20x%3D%22590%22%20y%3D%222490%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%227%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Long%20Trip%3A%20Assign%20Drivers%20(possibly%202%20per%20vehicle)%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2270%22%20width%3D%22260%22%20x%3D%22880%22%20y%3D%222660%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%228%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%229%22%20style%3D%22edgeStyle%3Dnone%3Bcurved%3D1%3Brounded%3D0%3BorthogonalLoop%3D1%3BjettySize%3Dauto%3Bhtml%3D1%3BfontSize%3D12%3BstartSize%3D8%3BendSize%3D8%3B%22%20target%3D%2225%22%20value%3D%22%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%229%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Short%20Trip%3A%20Assign%20Suitable%20Driver%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2270%22%20width%3D%22240%22%20x%3D%22100%22%20y%3D%222766%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2210%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%222%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Brounded%3D0%3Bhtml%3D1%3B%22%20target%3D%223%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2211%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%223%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%224%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2212%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%224%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%225%22%20value%3D%22No%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2213%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%224%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%226%22%20value%3D%22Yes%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2214%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%226%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%229%22%20value%3D%22No%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2215%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%226%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%227%22%20value%3D%22Yes%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2216%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%227%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3BentryX%3D0.5%3BentryY%3D0%3BentryDx%3D0%3BentryDy%3D0%3B%22%20target%3D%2225%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%3E%3CmxPoint%20x%3D%22560%22%20y%3D%222760%22%20as%3D%22targetPoint%22%2F%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2217%22%20parent%3D%221%22%20style%3D%22rhombus%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Passenger%20Capacity%20Check%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%22100%22%20width%3D%22180%22%20x%3D%22590%22%20y%3D%222899%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2218%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Assign%20Multiple%20Vehicles%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22200%22%20x%3D%22980%22%20y%3D%223100%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2219%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Assign%20One%20Suitable%20Vehicle%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%223110%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2220%22%20edge%3D%221%22%20parent%3D%221%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2218%22%20value%3D%22Exceeds%20capacity%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%3E%3CmxPoint%20x%3D%22769.9999999999986%22%20y%3D%222951.0000000000005%22%20as%3D%22sourcePoint%22%2F%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2221%22%20edge%3D%221%22%20parent%3D%221%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2219%22%20value%3D%22Within%20capacity%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%3E%3CmxPoint%20x%3D%22680%22%20y%3D%223000.9999999999995%22%20as%3D%22sourcePoint%22%2F%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2222%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2218%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3BentryX%3D1%3BentryY%3D0.5%3BentryDx%3D0%3BentryDy%3D0%3B%22%20target%3D%2226%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%3E%3CArray%20as%3D%22points%22%3E%3CmxPoint%20x%3D%221080%22%20y%3D%223260%22%2F%3E%3CmxPoint%20x%3D%22790%22%20y%3D%223260%22%2F%3E%3C%2FArray%3E%3CmxPoint%20x%3D%22790%22%20y%3D%223260.0000000000005%22%20as%3D%22targetPoint%22%2F%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2223%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2219%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3BentryX%3D0.5%3BentryY%3D0%3BentryDx%3D0%3BentryDy%3D0%3B%22%20target%3D%2226%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%3E%3CmxPoint%20x%3D%22680%22%20y%3D%223229.9999999999995%22%20as%3D%22targetPoint%22%2F%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2224%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2225%22%20style%3D%22edgeStyle%3Dnone%3Bcurved%3D1%3Brounded%3D0%3BorthogonalLoop%3D1%3BjettySize%3Dauto%3Bhtml%3D1%3BentryX%3D0.5%3BentryY%3D0%3BentryDx%3D0%3BentryDy%3D0%3BfontSize%3D12%3BstartSize%3D8%3BendSize%3D8%3B%22%20target%3D%2217%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2225%22%20parent%3D%221%22%20style%3D%22whiteSpace%3Dwrap%3Bhtml%3D1%3Brounded%3D1%3B%22%20value%3D%22Assign%20Vehicle(s)%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2269%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%222766%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2226%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23dae8fc%3B%22%20value%3D%22Pre-Trip%20Inspection%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%223230%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2227%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2229%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Brounded%3D0%3BorthogonalLoop%3D1%3BjettySize%3Dauto%3Bhtml%3D1%3BentryX%3D1%3BentryY%3D0.5%3BentryDx%3D0%3BentryDy%3D0%3BfontSize%3D12%3BstartSize%3D8%3BendSize%3D8%3BexitX%3D1%3BexitY%3D0.5%3BexitDx%3D0%3BexitDy%3D0%3B%22%20target%3D%2225%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%3E%3CArray%20as%3D%22points%22%3E%3CmxPoint%20x%3D%221240%22%20y%3D%223410%22%2F%3E%3CmxPoint%20x%3D%221240%22%20y%3D%222801%22%2F%3E%3C%2FArray%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2228%22%20connectable%3D%220%22%20parent%3D%2227%22%20style%3D%22edgeLabel%3Bhtml%3D1%3Balign%3Dcenter%3BverticalAlign%3Dmiddle%3Bresizable%3D0%3Bpoints%3D%5B%5D%3BfontSize%3D12%3B%22%20value%3D%22No%22%20vertex%3D%221%22%3E%3CmxGeometry%20relative%3D%221%22%20x%3D%220.0351%22%20y%3D%221%22%20as%3D%22geometry%22%3E%3CmxPoint%20as%3D%22offset%22%2F%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2229%22%20parent%3D%221%22%20style%3D%22rhombus%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Inspection%20Passed%3F%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%22100%22%20width%3D%22180%22%20x%3D%22590%22%20y%3D%223360%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2230%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23d5e8d4%3B%22%20value%3D%22Transportation%20In%20Progress%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%223540%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2231%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23ffe6cc%3B%22%20value%3D%22Post-Trip%20Inspection%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%223630%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2232%22%20parent%3D%221%22%20style%3D%22rhombus%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Defect%20Found%3F%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%22100%22%20width%3D%22180%22%20x%3D%22590%22%20y%3D%223740%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2233%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23f8cecc%3B%22%20value%3D%22Maintenance%20Workflow%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22900%22%20y%3D%223760%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2234%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2226%22%20target%3D%2229%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2235%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2229%22%20style%3D%22exitX%3D0.5%3BexitY%3D1%3BexitDx%3D0%3BexitDy%3D0%3B%22%20target%3D%2230%22%20value%3D%22Yes%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%3E%3CmxPoint%20x%3D%22680%22%20y%3D%223510%22%20as%3D%22sourcePoint%22%2F%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2236%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2230%22%20target%3D%2231%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2237%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2231%22%20target%3D%2232%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2238%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2232%22%20style%3D%22entryX%3D0.5%3BentryY%3D0%3BentryDx%3D0%3BentryDy%3D0%3B%22%20target%3D%2240%22%20value%3D%22No%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%3E%3CmxPoint%20x%3D%22680%22%20y%3D%223870%22%20as%3D%22targetPoint%22%2F%3E%3C%2FmxGeometry%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2239%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2232%22%20target%3D%2233%22%20value%3D%22Yes%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2240%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Report%20%26amp%3B%20Feedback%20Submission%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%223880%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2241%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23d5e8d4%3B%22%20value%3D%22Completed%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22570%22%20y%3D%224000%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2242%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2240%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2241%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3C%2Froot%3E%3C%2FmxGraphModel%3E


this is driver workflow : 

%3CmxGraphModel%3E%3Croot%3E%3CmxCell%20id%3D%220%22%2F%3E%3CmxCell%20id%3D%221%22%20parent%3D%220%22%2F%3E%3CmxCell%20id%3D%222%22%20parent%3D%221%22%20style%3D%22text%3Bhtml%3D1%3BfontSize%3D16%3Balign%3Dcenter%3BstrokeColor%3Dnone%3BfillColor%3Dnone%3B%22%20value%3D%22BPMN%20-%20Driver%20Leave%20vs%20Transportation%20Scheduling%20(With%20Exception%20Handling)%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2240%22%20width%3D%22700%22%20x%3D%22420%22%20y%3D%224380%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%223%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23dae8fc%3B%22%20value%3D%22Driver%20submits%20leave%20request%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22430%22%20y%3D%224430%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%224%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Check%20leave%20validity%20(dates%2C%20policy%2C%20quota)%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22240%22%20x%3D%22420%22%20y%3D%224550%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%225%22%20parent%3D%221%22%20style%3D%22rhombus%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Leave%20valid%3F%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%22100%22%20width%3D%22180%22%20x%3D%22450%22%20y%3D%224672.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%226%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23f8cecc%3B%22%20value%3D%22REJECT%3A%20Invalid%20Leave%20Request%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22200%22%20x%3D%22-70%22%20y%3D%224802.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%227%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Check%20overlap%20with%20transport%20assignments%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22260%22%20x%3D%22720%22%20y%3D%224692.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%228%22%20parent%3D%221%22%20style%3D%22rhombus%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Overlap%20exists%3F%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%22100%22%20width%3D%22180%22%20x%3D%22900%22%20y%3D%224872.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%229%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23d5e8d4%3B%22%20value%3D%22APPROVE%20LEAVE%20(No%20conflict)%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22220%22%20x%3D%22517.5%22%20y%3D%225042.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2210%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Check%20replacement%20driver%20availability%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22260%22%20x%3D%22862.5%22%20y%3D%225102.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2211%22%20parent%3D%221%22%20style%3D%22rhombus%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3B%22%20value%3D%22Replacement%20driver%20available%3F%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%22100%22%20width%3D%22200%22%20x%3D%22700%22%20y%3D%225203.0599999999995%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2212%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23d5e8d4%3B%22%20value%3D%22APPROVE%20LEAVE%20%2B%20Reassign%20Transport%20Duty%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2270%22%20width%3D%22260%22%20x%3D%22330%22%20y%3D%225218.0599999999995%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2213%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23f8cecc%3B%22%20value%3D%22EXCEPTION%3A%20No%20replacement%20driver%20available%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22280%22%20x%3D%22660%22%20y%3D%225412.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2214%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23f8cecc%3B%22%20value%3D%22REJECT%20or%20RETURN%20for%20rescheduling%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22260%22%20x%3D%22-90%22%20y%3D%225042.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2215%22%20parent%3D%221%22%20style%3D%22rounded%3D1%3BwhiteSpace%3Dwrap%3Bhtml%3D1%3BfillColor%3D%23e1d5e7%3B%22%20value%3D%22End%20Process%22%20vertex%3D%221%22%3E%3CmxGeometry%20height%3D%2260%22%20width%3D%22200%22%20x%3D%22230%22%20y%3D%225042.999999999999%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2216%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%223%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%224%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2217%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%224%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%225%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2218%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%225%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%226%22%20value%3D%22No%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2219%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%225%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%227%22%20value%3D%22Yes%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2220%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%227%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%228%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2221%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%228%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%229%22%20value%3D%22No%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2222%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%228%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2210%22%20value%3D%22Yes%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2223%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2210%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2211%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2224%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2211%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2212%22%20value%3D%22Yes%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2225%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2211%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2213%22%20value%3D%22No%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2226%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2213%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2214%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2227%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%226%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2215%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2228%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%229%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2215%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2229%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2212%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2215%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3CmxCell%20id%3D%2230%22%20edge%3D%221%22%20parent%3D%221%22%20source%3D%2214%22%20style%3D%22edgeStyle%3DorthogonalEdgeStyle%3Bhtml%3D1%3B%22%20target%3D%2215%22%3E%3CmxGeometry%20relative%3D%221%22%20as%3D%22geometry%22%2F%3E%3C%2FmxCell%3E%3C%2Froot%3E%3C%2FmxGraphModel%3E

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



