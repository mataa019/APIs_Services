# Web Services APIs

## Description
This project provides a set of RESTful APIs for managing TODO items. The APIs support basic CRUD operations: Create, Read, Update, and Delete.

## Endpoints

### GET /api/todos/
- **Description**: Retrieve a list of TODO items.
- **Response Codes**:
  - `200 OK`: Successfully retrieved the list.
  - `404 Not Found`: Endpoint not found.

### POST /api/todos/
- **Description**: Create a new TODO item.
- **Response Codes**:
  - `201 Created`: Successfully created the TODO item.
  - `404 Not Found`: Endpoint not found.

### PUT /api/todos/
- **Description**: Update an existing TODO item.
- **Response Codes**:
  - `200 OK`: Successfully updated the TODO item.
  - `404 Not Found`: Endpoint not found.

### DELETE /api/todos/
- **Description**: Delete a TODO item.
- **Response Codes**:
  - `200 OK`: Successfully deleted the TODO item.
  - `404 Not Found`: Endpoint not found.

## Usage
