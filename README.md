# ltw-project-g10

## Members

- Ana Inês Oliveira Barros - up201806593@fe.up.pt
- João de Jesus Costa - up201806560@fe.up.pt
- João Lucas Silva Martins - up201806436@fe.up.pt
- Ricardo Fontão - up201806317@fe.up.pt

## Mockups

### Search Page

![Main list interface](/documentation/mockups/list.png)

### Post Page

![Pet post page](/documentation/mockups/petPage.png)

### Profile Page

![Profile page](/documentation/mockups/profilePage.png)

## Navigation

![Navigation Diagram](/documentation/navigation_diagram.png)

## Database

![Relational SQLite](/documentation/database_relational.png)

![UML](/documentation/uml.png)

# Credentials (username/password (role))
 - john/1234 (admin)
 - mary/9999 (client)

# Libraries:
None

# Features:
 - Security
     - XSS: yes
     - CSRF: yes
     - SQL using prepare/execute: yes
     - Passwords: Bcrypt [work = 12] with random salt
     - Data Validation: regex / php
     - Other: Session fixation / Session hijacking / 
 - Technologies
     - Separated logic/database/presentation: yes
     - Semantic HTML tags: yes
     - Responsive CSS: yes
     - Javascript: yes
     - Ajax: yes
     - REST API: yes
     - Other: 
  Usability:
     - Error/success messages: yes
     - Forms don't lose data on error: no

