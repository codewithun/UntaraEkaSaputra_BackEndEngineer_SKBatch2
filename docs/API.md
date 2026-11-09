# Applicant Management API Documentation

Base URL:

```text
http://127.0.0.1:8000/api
```

All request and response bodies use JSON.

## 1. Create Applicant

Create a new applicant record.

**Endpoint**

```http
POST /applicants
```

**Request Body**

```json
{
    "name": "Budi Santoso",
    "email": "budi@example.com",
    "phone": "081234567890"
}
```

**Success Response — 201 Created**

```json
{
    "message": "Applicant created successfully.",
    "data": {
        "id": 1,
        "name": "Budi Santoso",
        "email": "budi@example.com",
        "phone": "081234567890",
        "stage": "applied",
        "created_at": "2026-11-09T22:48:02.000000Z",
        "updated_at": "2026-11-09T22:48:02.000000Z"
    }
}
```

**Validation Rules**

| Field | Rules                                                 |
| ----- | ----------------------------------------------------- |
| name  | Required, string, maximum 100 characters              |
| email | Required, valid email, unique, maximum 255 characters |
| phone | Optional, string, maximum 20 characters               |

**Validation Error — 422 Unprocessable Entity**

```json
{
    "message": "The email has already been taken.",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

## 2. List Applicants

Retrieve all applicant records, ordered by latest creation date.

**Endpoint**

```http
GET /applicants
```

**Success Response — 200 OK**

```json
{
    "message": "Applicants retrieved successfully.",
    "data": [
        {
            "id": 1,
            "name": "Budi Santoso",
            "email": "budi@example.com",
            "phone": "081234567890",
            "stage": "applied",
            "created_at": "2026-11-09T22:48:02.000000Z",
            "updated_at": "2026-11-09T22:48:02.000000Z"
        }
    ]
}
```

## 3. Update Applicant Stage

Update the recruitment stage of an existing applicant.

**Endpoint**

```http
PATCH /applicants/{id}/stage
```

**Request Body**

```json
{
    "stage": "interview"
}
```

**Available Stages**

| Stage       | Description           |
| ----------- | --------------------- |
| `applied`   | Application submitted |
| `screening` | Application screening |
| `interview` | Interview process     |
| `offered`   | Job offer sent        |
| `hired`     | Applicant hired       |
| `rejected`  | Application rejected  |

**Success Response — 200 OK**

```json
{
    "message": "Applicant stage updated successfully.",
    "data": {
        "id": 1,
        "name": "Budi Santoso",
        "email": "budi@example.com",
        "phone": "081234567890",
        "stage": "interview",
        "created_at": "2026-11-09T22:48:02.000000Z",
        "updated_at": "2026-11-09T22:49:49.000000Z"
    }
}
```

**Validation Error — 422 Unprocessable Entity**

Returned when the provided stage is not supported.

**Not Found — 404 Not Found**

```json
{
    "message": "Applicant not found."
}
```

## HTTP Status Codes

| Status Code | Description                    |
| ----------- | ------------------------------ |
| 200         | Request successful             |
| 201         | Applicant created successfully |
| 404         | Applicant not found            |
| 422         | Validation failed              |
