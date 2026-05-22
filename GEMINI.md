Business scenario :

I want to develop Land Transport Coordination System. currently operating workflow is below : 

User/Customer request the route (with car and driver) to Land Transport Coordinator from email. 
The user can request route for others also. (Like Requesting Transportation for team members.)
if the route can be long or short trip. long trips mean from one city to another. 
the long trip need to request 5 days in advanced. the urgent requests can be done by specific users(like manager roles).
if it's long trip need to assign two drivers for one car for safety.
The Car need to be checked by driver assigned by Land Transport Coordinator if the car is assigned for route.
Sometimes User reject the route request or edit, so The Land Transportation coordinator need to check again eventhough its accepted. 

When the route Request started : 

- The Land Transportation Coordinator check the Request, 
    The Land Transportation coordinator check which car or more to assign, one or more drivers to assign based on route. if the route requested is for how many person and check the car capacity, need to assign more cars or one car which can hold enough people. 
    Needs to check which driver to assign, which drivers are free(sometimes ask driver and confirm, check Leave requests), their working hours not exceeding 10hours if exceeded how many overtime left for one week. (maximum 5hours per week)
    If the Driver is pre-requested the leave and accepted before, the Land Transport Coordinator can't assign him if its within leave.
    The drivers can request leave to land transport coordinator. they can edit or delete the request.
    If the driver didn't have accepted leave request, the land transport coordinator map the driver with route. 
    The Land Transport coordinator cannot assign another route to him during the operation. When the driver said the route is completed, they can only reassign him another route. 

- The Land Transport Coordinator need to assign drivers for checking cars daily/weekly/monthly. the check list is given to drivers for each cars. The Land Transport Coordinator need to update daily sheet for routes fuel consumption, total (km), for the cars - daily checking status, last fuel refil time, litre, total distance, estimated fuel consumption. drivers total leave available, leave taken, leave type, leave hours.

Business discovery to do : 
- Business Rules
- Workflows 
- Domain Models 
- System Design
- Database Design
- APIs
- UIs

Tech Stacks : 
Backend : Laravel 
Frontend : React,React Query, Tailwind
Database : Postgres SQL
AI


Required Documents
1. Business Requirement Specification (BRS)

Defines business behavior.

2. Functional Requirement Specification (FRS)

Defines system functions.

3. Workflow Diagrams

Critical.

4. Database ERD

Entities and relationships.

5. Business Rule Catalog

Absolutely mandatory.

6. Permission Matrix

Role access design.