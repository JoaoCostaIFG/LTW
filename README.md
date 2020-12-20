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

## Credentials (username/password)

**There are no admin accounts**.

**User accounts:**

- Padoru/123456
- Maynardo/123456
- Nachos/123456
- Irao/123456
- FontaoFontalhao/123456
- Lucas/123456
- Davide/123456
- João/123456
- CarlosPereira935/123456
- Canil da Trofa/123456
- Louisse221/12345

## Libraries

No libraries were used.

## Features

- **Security**:

  - XSS: **yes**
  - CSRF: **yes**
  - SQL using prepare/execute: **yes**
  - Passwords: **Bcrypt [work = 12] with random salt**
  - Data Validation: **regex** / **php**
  - Other: **Session fixation** / **Session hijacking**

- **Technologies**:

  - Separated logic/database/presentation: **yes**
  - Semantic HTML tags: **yes**
  - Responsive CSS: **yes**
  - Javascript: **yes**
  - Ajax: **yes**
  - REST API: **yes**
  - Other: **sessionStorage**

- **Usability**:

  - Error/success messages: **yes**
  - Forms don't lose data on error: **yes**

- **Extras**:
  - User profile pages with pet post list.
  - Answer editing.
  - Pet states.
  - Notifications about adoption proposals.
  - Accepting a proposal for a pet, automatically declines all other proposals
    for the same pet.
  - REST API: get all users, get a single user, create a new user, get all pet
    posts, get a single pet post, create a new pet post.

## Note

In the [session.php file](includes/session.php), the line:

```php
session_set_cookie_params(0, '/', '.up.pt', true, true);
```

helps mitigate the effects of XSS. It should be uncommented when the website
code is being hosted.
