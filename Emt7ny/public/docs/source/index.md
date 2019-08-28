---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Exam
<!-- START_72d1ed015c021175ad9b26612cdeacb5 -->
## Create Exam
A teacher creates exam and sets its title, instructions and duration.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
It returns the exam id, and then the teacher can add questions to it.
If there is no logged-in user or he is not a teacher, it returns an error

> Example request:

```bash
curl -X POST "http://localhost/api/CreateExam" \
    -H "Content-Type: application/json" \
    -d '{"title":"Arabic_Exam_2018","instructions":"calculators are not allowed","duration":"02:30"}'

```

```javascript
const url = new URL("http://localhost/api/CreateExam");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "title": "Arabic_Exam_2018",
    "instructions": "calculators are not allowed",
    "duration": "02:30"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "error": "The user is not a teacher"
}
```
> Example response (401):

```json
{
    "error": "The user is not authorized"
}
```
> Example response (200):

```json
{
    "id": 11
}
```

### HTTP Request
`POST api/CreateExam`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | The title of the exam.
    instructions | text |  optional  | The instructions of the exam (if any).
    duration | time |  optional  | The duration of the exam, must follow the format `"H:i"`, default is `02:30`.

<!-- END_72d1ed015c021175ad9b26612cdeacb5 -->

<!-- START_e6f3bf6e79e0b09f4e5e1cd66b5b06d6 -->
## Edit Exam
A teacher edits an exam title, instructions and duration.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Returns the exam data after edit.
If the logged-in user is not a registered teacher of the exam it returns an error.

> Example request:

```bash
curl -X PATCH "http://localhost/api/EditExam" \
    -H "Content-Type: application/json" \
    -d '{"id":11,"title":"Arabic_Exam_2018","instructions":"calculators are not allowed","duration":"02:30"}'

```

```javascript
const url = new URL("http://localhost/api/EditExam");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 11,
    "title": "Arabic_Exam_2018",
    "instructions": "calculators are not allowed",
    "duration": "02:30"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "error": "The user is not a teacher"
}
```
> Example response (401):

```json
{
    "error": "The user is not authorized"
}
```
> Example response (404):

```json
{
    "error": "The exam is not found"
}
```
> Example response (400):

```json
{
    "error": "the user is not a registered teacher of the exam"
}
```
> Example response (200):

```json
{
    "id": 11,
    "code": "45EeiadOFV",
    "duration": "02:30:00",
    "title": "english Exam 2018",
    "instructions": null,
    "teacherId": 12,
    "created_at": "2019-08-20 03:02:32",
    "updated_at": "2019-08-21 16:07:26"
}
```

### HTTP Request
`PATCH api/EditExam`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | The id of the exam to be edited.
    title | string |  optional  | The new title of the exam.
    instructions | text |  optional  | The new instructions of the exam.
    duration | time |  optional  | The new duration of the exam, must follow the format `"H:i"`, default is `02:30`.

<!-- END_e6f3bf6e79e0b09f4e5e1cd66b5b06d6 -->

<!-- START_82fc0150125d763685a1e3a6de676b4d -->
## View Exam
A user view an Exam data.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
It returns title, instructions, duration, fullmark and questions of the exam.
If the user isn't a registered student or teacher in the exam, it returns an error

> Example request:

```bash
curl -X POST "http://localhost/api/ViewExam" \
    -H "Content-Type: application/json" \
    -d '{"id":11}'

```

```javascript
const url = new URL("http://localhost/api/ViewExam");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 11
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "error": "The exam is not found"
}
```
> Example response (400):

```json
{
    "error": "the user is not a registerd student or teacher in the exam"
}
```
> Example response (401):

```json
{
    "error": "The user is not authorized"
}
```
> Example response (200):

```json
{
    "id": 21,
    "duration": "02:00:00",
    "title": "Arabic Exam 2018",
    "instructions": "be quite",
    "created_at": "2019-08-22 15:55:25",
    "updated_at": "2019-08-22 15:55:25",
    "full_mark": "6",
    "questions": [
        {
            "id": 1,
            "question": "Quae aut ex ex. Iure fuga voluptas vel culpa consectetur exercitationem. Ipsa dolores magnam amet aut.",
            "fullmark": 2,
            "examId": 21,
            "created_at": "2019-08-22 15:51:04",
            "updated_at": "2019-08-22 15:51:04",
            "choices": [],
            "pictures": [
                {
                    "id": 24,
                    "image": "public\\img\\GXCUy.jpg",
                    "questionId": 1
                }
            ]
        },
        {
            "id": 2,
            "question": "Eos officiis excepturi quaerat quibusdam ut. Hic esse provident voluptate qui voluptates molestiae aut. Est nam quia rerum eveniet nostrum.",
            "fullmark": 2,
            "examId": 21,
            "created_at": "2019-08-22 15:51:04",
            "updated_at": "2019-08-22 15:51:04",
            "choices": [],
            "pictures": []
        },
        {
            "id": 41,
            "question": "Quod totam ut iusto earum. Laboriosam vero eaque expedita sed. Laborum nemo officia aliquid in dolore.",
            "fullmark": 2,
            "examId": 21,
            "created_at": "2019-08-22 15:51:07",
            "updated_at": "2019-08-22 15:51:07",
            "choices": [
                {
                    "id": 1,
                    "choice": "Quidem doloribus quam officia placeat sint iusto veritatis architecto.",
                    "questionId": 41
                },
                {
                    "id": 2,
                    "choice": "Ut numquam modi dolorum.",
                    "questionId": 41
                },
                {
                    "id": 3,
                    "choice": "Beatae assumenda alias suscipit asperiores voluptatibus est.",
                    "questionId": 41
                },
                {
                    "id": 4,
                    "choice": "Quidem ducimus commodi rem dolor.",
                    "questionId": 41
                }
            ],
            "pictures": [
                {
                    "id": 30,
                    "image": "public\\img\\E5Xkx.jpg",
                    "questionId": 41
                }
            ]
        }
    ]
}
```

### HTTP Request
`POST api/ViewExam`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | The id of the exam to be viewed.

<!-- END_82fc0150125d763685a1e3a6de676b4d -->

<!-- START_7815f128979e6b0f91e6087d90da243d -->
## Delete Exam
The creator of the exam deletes the exam.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
The request returns a message that indicates that the exam is deleted successfully.
If the logged-in user is not the creator of the exam
(the first registered teacher of the exam), it returns an error.

> Example request:

```bash
curl -X DELETE "http://localhost/api/DeleteExam" \
    -H "Content-Type: application/json" \
    -d '{"id":11}'

```

```javascript
const url = new URL("http://localhost/api/DeleteExam");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 11
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "error": "The user is not authorized"
}
```
> Example response (404):

```json
{
    "error": "The exam is not found"
}
```
> Example response (400):

```json
{
    "error": "The user is not the creator of the exam"
}
```
> Example response (200):

```json
{
    "result": "The exam is deleted successfully"
}
```

### HTTP Request
`DELETE api/DeleteExam`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | The id of the exam to be deleted.

<!-- END_7815f128979e6b0f91e6087d90da243d -->

<!-- START_341cdb2cf502d00dfa983212aa69b4db -->
## Add Question
The registered teachers of the exam add question to it.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
It returns the id of the added question.
If the logged-in user is not a registered teacher of the exam, it returns an error

> Example request:

```bash
curl -X POST "http://localhost/api/AddQuestion" \
    -H "Content-Type: application/json" \
    -d '{"examId":11,"question":"What's the area of Egypt?","fullmark":2}'

```

```javascript
const url = new URL("http://localhost/api/AddQuestion");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "examId": 11,
    "question": "What's the area of Egypt?",
    "fullmark": 2
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "error": "The user is not authorized"
}
```
> Example response (404):

```json
{
    "error": "The exam is not found"
}
```
> Example response (400):

```json
{
    "error": "The user is not a registered teacher of the exam"
}
```
> Example response (200):

```json
{
    "id": 62
}
```

### HTTP Request
`POST api/AddQuestion`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    examId | integer |  required  | The id of the exam that the question is added to.
    question | text |  required  | The text of the question to be added.
    fullmark | integer |  optional  | The fullmark of the question to be added, default is 2.

<!-- END_341cdb2cf502d00dfa983212aa69b4db -->

<!-- START_0223a496ca82bf7145c1bcd29755c7bd -->
## Delete Question
The registered teachers of the exam removes a question.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
It returns a message that indicates that the question is deleted successfully from the exam.
If the logged-in user is not a registered teacher of the exam, it returns an error.
If the given question doesn't belong to the given exam, it returns an error.

> Example request:

```bash
curl -X DELETE "http://localhost/api/DeleteQuestion" \
    -H "Content-Type: application/json" \
    -d '{"examId":11,"questionId":9}'

```

```javascript
const url = new URL("http://localhost/api/DeleteQuestion");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "examId": 11,
    "questionId": 9
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "error": "The user is not authorized"
}
```
> Example response (404):

```json
{
    "error": "The exam is not found"
}
```
> Example response (400):

```json
{
    "error": "The user is not a registered teacher of the exam"
}
```
> Example response (404):

```json
{
    "error": "The question is not found"
}
```
> Example response (400):

```json
{
    "error": "The question doesn't belong to the exam"
}
```
> Example response (200):

```json
{
    "result": "The question is deleted successfully"
}
```

### HTTP Request
`DELETE api/DeleteQuestion`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    examId | integer |  required  | the id of the exam that the question is deleted from.
    questionId | integer |  required  | the id of the question to be deleted from the exam.

<!-- END_0223a496ca82bf7145c1bcd29755c7bd -->

#general
<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## login

login function

> Example request:

```bash
curl -X POST "http://localhost/api/login" 
```

```javascript
const url = new URL("http://localhost/api/login");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_90f45d502fd52fdc0b289e55ba3c2ec6 -->
## signup

signup function

> Example request:

```bash
curl -X POST "http://localhost/api/signup" 
```

```javascript
const url = new URL("http://localhost/api/signup");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/signup`


<!-- END_90f45d502fd52fdc0b289e55ba3c2ec6 -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## logout

logout function

> Example request:

```bash
curl -X POST "http://localhost/api/logout" 
```

```javascript
const url = new URL("http://localhost/api/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

<!-- START_3fba263a38f92fde0e4e12f76067a611 -->
## Refresh a token.

> Example request:

```bash
curl -X POST "http://localhost/api/refresh" 
```

```javascript
const url = new URL("http://localhost/api/refresh");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/refresh`


<!-- END_3fba263a38f92fde0e4e12f76067a611 -->

<!-- START_d131f717df7db546af1657d1e7ce10f6 -->
## Get the authenticated User.

> Example request:

```bash
curl -X POST "http://localhost/api/me" 
```

```javascript
const url = new URL("http://localhost/api/me");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/me`


<!-- END_d131f717df7db546af1657d1e7ce10f6 -->

<!-- START_8252a6042116102f42d66fb4728ffa7f -->
## sendPasswordResetLink

this function will send email to the user to reset the password

> Example request:

```bash
curl -X POST "http://localhost/api/sendPasswordResetLink" 
```

```javascript
const url = new URL("http://localhost/api/sendPasswordResetLink");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/sendPasswordResetLink`


<!-- END_8252a6042116102f42d66fb4728ffa7f -->

<!-- START_b4f4625b609a18310a50b1dddf752a55 -->
## api/resetPassword
> Example request:

```bash
curl -X POST "http://localhost/api/resetPassword" 
```

```javascript
const url = new URL("http://localhost/api/resetPassword");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/resetPassword`


<!-- END_b4f4625b609a18310a50b1dddf752a55 -->

<!-- START_0b6b40575d0a5a6ab989fdc40b3bb8de -->
## EditProfile

this function will edit the profile of the user like edit (Photo  , name , password)

> Example request:

```bash
curl -X PATCH "http://localhost/api/EditProfile" \
    -H "Content-Type: application/json" \
    -d '{"name":"consequuntur","password":"perspiciatis","image":"at"}'

```

```javascript
const url = new URL("http://localhost/api/EditProfile");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "consequuntur",
    "password": "perspiciatis",
    "image": "at"
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "status": "true",
    "userId": 2,
    "userName": "Waleed",
    "image": null
}
```
> Example response (404):

```json
{
    "status": "false",
    "errors": "The name must be a string."
}
```
> Example response (201):

```json
{
    "status": "false",
    "Message": "nothing to be updated"
}
```

### HTTP Request
`PATCH api/EditProfile`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  optional  | The new name of the user.
    password | string |  optional  | The new password of the user.
    image | binary |  optional  | The new image of the user.

<!-- END_0b6b40575d0a5a6ab989fdc40b3bb8de -->

<!-- START_106f0ed7641ecdc722f6dafc9527a291 -->
## ViewProfile

this function will view the profile of the user

> Example request:

```bash
curl -X GET -G "http://localhost/api/ViewProfile" 
```

```javascript
const url = new URL("http://localhost/api/ViewProfile");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "status": "true",
    "userId": 2,
    "userName": "Waleed",
    "image": null,
    "status_user": null,
    "email": "ahmdwaleed@gmail.com"
}
```
> Example response (404):

```json
{
    "status": "false",
    "Message": "There are a problem in this user"
}
```

### HTTP Request
`GET api/ViewProfile`


<!-- END_106f0ed7641ecdc722f6dafc9527a291 -->

<!-- START_f96f931eca837e23a9398eeac5535f84 -->
## DeleteProfile

this function will delete the profile of the user

> Example request:

```bash
curl -X DELETE "http://localhost/api/DeleteProfile" 
```

```javascript
const url = new URL("http://localhost/api/DeleteProfile");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "status": "true",
    "Message": "user is deleted"
}
```
> Example response (404):

```json
{
    "status": "false",
    "Message": "There are a problem in this user or already deleted"
}
```

### HTTP Request
`DELETE api/DeleteProfile`


<!-- END_f96f931eca837e23a9398eeac5535f84 -->

<!-- START_28fc0f72455b8a439bf2ff774f3103c1 -->
## viewTeacherExams

this function will view the infromations about the eaxams of the theacher

> Example request:

```bash
curl -X GET -G "http://localhost/api/ViewTeacherExams" 
```

```javascript
const url = new URL("http://localhost/api/ViewTeacherExams");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "status": "success",
    "pages": [
        {
            "id": 1,
            "code": "2006",
            "duration": "00:00:00",
            "instructions": "Answer",
            "teacherId": 3,
            "created_at": "2019-08-21 00:00:00",
            "updated_at": "2019-08-21 00:00:00"
        }
    ]
}
```
> Example response (404):

```json
{
    "status": "false",
    "Message": "There are a problem in this user or already deleted"
}
```

### HTTP Request
`GET api/ViewTeacherExams`


<!-- END_28fc0f72455b8a439bf2ff774f3103c1 -->

<!-- START_82cc58ca50669509b710365da6411bd9 -->
## ViewStudentExams

this function will view the infromations about the eaxams of the student

> Example request:

```bash
curl -X GET -G "http://localhost/api/ViewStudentExams" 
```

```javascript
const url = new URL("http://localhost/api/ViewStudentExams");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "status": "success",
    "pages": [
        {
            "id": 1,
            "code": "2006",
            "duration": "00:00:00",
            "instructions": "Answer",
            "teacherId": 3,
            "created_at": "2019-08-21 00:00:00",
            "updated_at": "2019-08-21 00:00:00"
        }
    ]
}
```
> Example response (404):

```json
{
    "status": "false",
    "Message": "There are a problem in this user or already deleted"
}
```

### HTTP Request
`GET api/ViewStudentExams`


<!-- END_82cc58ca50669509b710365da6411bd9 -->


