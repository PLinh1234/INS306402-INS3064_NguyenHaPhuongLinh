## Part 1: Normalization

### Original Table
Student_Grades_Raw

Columns:  
StudentID, StudentName, CourseID, CourseName, ProfessorName, ProfessorEmail, Grade

Example Data:

| StudentID | StudentName | CourseID | CourseName | ProfessorName | ProfessorEmail | Grade |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| 1 | Nguyen An | 101 | Database Systems | Dr. Le | le@uni.edu | A |
| 1 | Nguyen An | 102 | Web Development | Dr. Tran | tran@uni.edu | B+ |
| 2 | Tran Binh | 101 | Database Systems | Dr. Le | le@uni.edu | A- |

---

## Task 1: Identify Violations

### Redundant Columns

The following columns cause redundancy because they repeat across multiple rows:

- StudentName
- CourseName
- ProfessorName
- ProfessorEmail

For example, if a student takes multiple courses, the same **StudentName** appears repeatedly.  
Similarly, **CourseName** and **Professor information** are repeated for many records.

---

### Update Anomalies

1. **Professor Email Change**  
If a professor changes their email address, every row containing that professor must be updated.

2. **Course Rename**  
If the name of a course changes, all rows with the same CourseID must also be updated.

These situations create a high risk of inconsistent data.

---

### Transitive Dependencies

The table contains several transitive dependencies:

StudentID → StudentName  

CourseID → CourseName  

ProfessorName → ProfessorEmail  

CourseID → ProfessorName → ProfessorEmail  

Because non-key attributes depend on other non-key attributes, the table does not satisfy **Third Normal Form (3NF)**.

---

## Task 2: Decompose to 3NF

To remove redundancy and anomalies, the table can be decomposed into the following normalized tables.

| Table | Primary Key | Foreign Key(s) | Non-key columns |
| :--- | :--- | :--- | :--- |
| Students | student_id | None | student_name |
| Professors | professor_id | None | professor_name, professor_email |
| Courses | course_id | professor_id | course_name |
| Enrollments | (student_id, course_id) | student_id, course_id | grade |

---

## Explanation

**Students**  
Stores information about each student. Separating this table prevents student names from being repeated in multiple records.

**Professors**  
Stores professor information such as name and email. This ensures that professor details are maintained in one place.

**Courses**  
Stores course information and connects each course to a professor through a foreign key.

**Enrollments**  
Represents the relationship between students and courses. It records which student takes which course and stores the grade received.

## Part 2: Relationships

### 1. Author — Book

Relationship Type: One-to-Many (1:N)

FK Location: book.author_id

Explanation: One author can write many books, but each book has only one author.

---

### 2. Citizen — Passport

Relationship Type: One-to-One (1:1)

FK Location: passport.citizen_id

Explanation: Each citizen has only one passport, and each passport belongs to one citizen.

---

### 3. Customer — Order

Relationship Type: One-to-Many (1:N)

FK Location: orders.customer_id

Explanation: One customer can place many orders, but each order belongs to only one customer.

---

### 4. Student — Class

Relationship Type: Many-to-Many (N:N)

FK Location: student_class.student_id, student_class.class_id (junction table)

Explanation: A student can take many classes, and a class can have many students.  
This requires a junction table called **student_class**.

---

### 5. Team — Player

Relationship Type: One-to-Many (1:N)

FK Location: player.team_id

Explanation: One team can have many players, but each player belongs to one team.