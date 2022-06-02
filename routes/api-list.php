#[GET] api/sync
#[GET] api/privacy-permission/{id}
#[GET] api/privacy-permission-status
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/is-enabled
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/login
#[GET] api/viewAllNotification/{user_id}
#[POST] api/child-bank-slip-store
#[GET] api/class-id/{id}
#[GET] api/section-id/{id}
#[GET] api/teacher-id/{id}
#[GET] api/subject-id/{id}
#[GET] api/room-id/{id}
#[GET] api/class-period-id/{id}
#[GET] api/visitor
#[POST] api/visitor-store
#[GET] api/visitor-edit/{id}
#[POST] api/visitor-update
#[GET] api/visitor-delete/{id}
#[GET] api/complaint
#[POST] api/complaint-store
#[GET] api/complaint-edit/{id}
#[POST] api/complaint-update
#[GET] api/complaint-delete/{id}
#[GET] api/postal-receive
#[POST] api/postal-receive-store
#[POST] api/postal-receive-edit/{id}
#[POST] api/postal-receive-update
#[GET] api/postal-receive-delete/{id}
#[GET] api/postal-dispatch
#[POST] api/postal-dispatch-store
#[GET] api/postal-dispatch-edit/{id}
#[POST] api/postal-dispatch-update
#[GET] api/postal-dispatch-delete/{id}
#[GET] api/phone-call
#[GET] api/phone-call/create
#[POST] api/phone-call
#[GET] api/phone-call/{phone_call}
#[GET] api/phone-call/{phone_call}/edit
#[PUT,PATCH] api/phone-call/{phone_call}
#[DELETE] api/phone-call/{phone_call}
#[GET] api/setup-admin
#[GET] api/setup-admin/create
#[POST] api/setup-admin
#[GET] api/setup-admin/{setup_admin}
#[GET] api/setup-admin/{setup_admin}/edit
#[PUT,PATCH] api/setup-admin/{setup_admin}
#[DELETE] api/setup-admin/{setup_admin}
#[GET] api/setup-admin-delete/{id}
#[GET] api/student-list
#[POST] api/student-list-search
#[GET] api/student-list-search
#[GET] api/student-view/{id}
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/student-delete
#[GET] api/student-edit/{id}
#[GET] api/student-attendance
#[POST] api/student-search
#[GET] api/student-search
#[POST] api/student-attendance-store
#[GET] api/student-attendance-report
#[POST] api/student-attendance-report-search
#[GET] api/student-attendance-report-search
#[GET] api/student-category
#[POST] api/student-category-store
#[GET] api/student-category-edit/{id}
#[POST] api/student-category-update
#[GET] api/student-category-delete/{id}
#[GET] api/student-group
#[POST] api/student-group-store
#[GET] api/student-group-edit/{id}
#[POST] api/student-group-update
#[GET] api/student-group-delete/{id}
#[GET] api/student-promote
#[GET] api/student-current-search
#[POST] api/student-current-search
#[GET] api/view-academic-performance/{id}
#[GET] api/student-promote-store
#[POST] api/student-promote-store
#[GET] api/disabled-student
#[POST] api/disabled-student
#[GET] api/upload-content
#[POST] api/save-upload-content
#[GET] api/delete-upload-content/{id}
#[GET] api/assignment-list
#[GET] api/study-metarial-list
#[GET] api/syllabus-list
#[GET] api/other-download-list
#[GET] api/collect-fees
#[GET] api/fees-collect-student-wise/{id}
#[POST] api/collect-fees
#[GET] api/search-fees-payment
#[POST] api/fees-payment-search
#[GET] api/fees-payment-search
#[GET] api/search-fees-due
#[POST] api/fees-due-search
#[GET] api/fees-due-search
#[POST] api/fees-master-single-delete
#[POST] api/fees-master-group-delete
#[GET] api/fees-assign/{id}
#[POST] api/fees-assign-search
#[GET] api/fees-master-store
#[GET] api/fees-master-update
#[GET] api/fees-group
#[GET] api/fees-group-store
#[GET] api/fees-group-edit/{id}
#[GET] api/fees-group-update
#[POST] api/fees-group-delete
#[GET] api/fees-type
#[GET] api/fees-type-store
#[GET] api/fees-type-edit/{id}
#[GET] api/fees-type-update
#[GET] api/fees-type-delete/{id}
#[GET] api/fees-discount
#[POST] api/fees-discount-store
#[GET] api/fees-discount-edit/{id}
#[POST] api/fees-discount-update
#[GET] api/fees-discount-delete/{id}
#[GET] api/fees-discount-assign/{id}
#[POST] api/fees-discount-assign-search
#[GET] api/fees-discount-assign-store
#[GET] api/fees-generate-modal/{amount}/{student_id}/{type}
#[GET] api/fees-discount-amount-search
#[POST] api/fees-payment-delete
#[GET] api/fees-forward
#[POST] api/fees-forward-search
#[GET] api/fees-forward-search
#[POST] api/fees-forward-store
#[GET] api/fees-forward-store
#[GET] api/profit
#[POST] api/search-profit-by-date
#[GET] api/search-profit-by-date
#[GET] api/add-income
#[POST] api/add-income-store
#[GET] api/add-income-edit/{id}
#[POST] api/add-income-update
#[POST] api/add-income-delete
#[GET] api/add-expense
#[GET] api/add-expense/create
#[POST] api/add-expense
#[GET] api/add-expense/{add_expense}
#[GET] api/add-expense/{add_expense}/edit
#[PUT,PATCH] api/add-expense/{add_expense}
#[DELETE] api/add-expense/{add_expense}
#[GET] api/payment-method
#[POST] api/payment-method-store
#[GET] api/payment-method-edit/{id}
#[POST] api/payment-method-update
#[GET] api/payment-method-delete/{id}
#[GET] api/staff-directory
#[GET] api/staff-roles
#[GET] api/staff-list/{role_id}
#[GET] api/staff-view/{id}
#[GET] api/search-staff
#[POST] api/search-staff
#[GET] api/deleteStaff/{id}
#[GET] api/staff-attendance
#[POST] api/staff-attendance-search
#[POST] api/staff-attendance-store
#[GET] api/staff-attendance-report
#[POST] api/staff-attendance-report-search
#[GET] api/designation
#[GET] api/designation/create
#[POST] api/designation
#[GET] api/designation/{designation}
#[GET] api/designation/{designation}/edit
#[PUT,PATCH] api/designation/{designation}
#[DELETE] api/designation/{designation}
#[GET] api/department
#[GET] api/department/create
#[POST] api/department
#[GET] api/department/{department}
#[GET] api/department/{department}/edit
#[PUT,PATCH] api/department/{department}
#[DELETE] api/department/{department}
#[GET] api/approve-leave
#[POST] api/approve-leave-store
#[GET] api/approve-leave-edit/{id}
#[GET] api/staffNameByRole
#[POST] api/update-approve-leave
#[GET] api/view-leave-details-approve/{id}
#[GET] api/apply-leave
#[POST] api/apply-leave-store
#[GET] api/apply-leave-edit/{id}
#[POST] api/apply-leave-update
#[GET] api/view-leave-details-apply/{id}
#[GET] api/delete-apply-leave/{id}
#[GET] api/student-apply-leave
#[GET] api/student-view-leave-details-apply/{id}
#[GET] api/student-apply-leave-edit/{id}
#[POST] api/student-apply-leave-update
#[POST] api/student-apply-leave-store
#[GET] api/student-delete-apply-leave/{id}
#[GET] api/leave-define
#[GET] api/leave-define/create
#[POST] api/leave-define
#[GET] api/leave-define/{leave_define}
#[GET] api/leave-define/{leave_define}/edit
#[PUT,PATCH] api/leave-define/{leave_define}
#[DELETE] api/leave-define/{leave_define}
#[GET] api/leave-type
#[GET] api/leave-type/create
#[POST] api/leave-type
#[GET] api/leave-type/{leave_type}
#[GET] api/leave-type/{leave_type}/edit
#[PUT,PATCH] api/leave-type/{leave_type}
#[DELETE] api/leave-type/{leave_type}
#[GET] api/marks-grade
#[GET] api/marks-grade/create
#[POST] api/marks-grade
#[GET] api/marks-grade/{marks_grade}
#[GET] api/marks-grade/{marks_grade}/edit
#[PUT,PATCH] api/marks-grade/{marks_grade}
#[DELETE] api/marks-grade/{marks_grade}
#[GET] api/class-routine-new
#[POST] api/class-routine-new
#[GET] api/assign-subject
#[GET] api/assign-subject-create
#[POST] api/assign-subject-search
#[GET] api/assign-subject-search
#[POST] api/assign-subject-store
#[GET] api/assign-subject-store
#[POST] api/assign-subject
#[GET] api/assign-subject-get-by-ajax
#[GET] api/assign-class-teacher
#[GET] api/assign-class-teacher/create
#[POST] api/assign-class-teacher
#[GET] api/assign-class-teacher/{assign_class_teacher}
#[GET] api/assign-class-teacher/{assign_class_teacher}/edit
#[PUT,PATCH] api/assign-class-teacher/{assign_class_teacher}
#[DELETE] api/assign-class-teacher/{assign_class_teacher}
#[GET] api/subject
#[POST] api/subject-store
#[GET] api/subject-edit/{id}
#[POST] api/subject-update
#[GET] api/subject-delete/{id}
#[GET] api/class
#[POST] api/class-store
#[GET] api/class-edit/{id}
#[POST] api/class-update
#[GET] api/class-delete/{id}
#[GET] api/section
#[POST] api/section-store
#[GET] api/section-edit/{id}
#[POST] api/section-update
#[GET] api/section-delete/{id}
#[GET] api/class-room
#[GET] api/class-room/create
#[POST] api/class-room
#[GET] api/class-room/{class_room}
#[GET] api/class-room/{class_room}/edit
#[PUT,PATCH] api/class-room/{class_room}
#[DELETE] api/class-room/{class_room}
#[GET] api/class-time
#[GET] api/class-time/create
#[POST] api/class-time
#[GET] api/class-time/{class_time}
#[GET] api/class-time/{class_time}/edit
#[PUT,PATCH] api/class-time/{class_time}
#[DELETE] api/class-time/{class_time}
#[GET] api/student-class-routine/{id}
#[GET] api/homework-list
#[POST] api/homework-list
#[GET] api/notice-list
#[GET] api/send-message
#[POST] api/save-notice-data
#[GET] api/edit-notice/{id}
#[POST] api/update-notice-data
#[GET] api/delete-notice-view/{id}
#[GET] api/send-email-sms-view
#[GET] api/delete-notice/{id}
#[GET] api/event
#[GET] api/event/create
#[POST] api/event
#[GET] api/event/{event}
#[GET] api/event/{event}/edit
#[PUT,PATCH] api/event/{event}
#[DELETE] api/event/{event}
#[GET] api/delete-event-view/{id}
#[GET] api/delete-event/{id}
#[GET] api/book-list
#[GET] api/save-book-data
#[GET] api/edit-book/{id}
#[GET] api/update-book-data/{id}
#[GET] api/delete-book-view/{id}
#[GET] api/delete-book/{id}
#[GET] api/member-list
#[GET] api/issue-books/{member_type}/{id}
#[GET] api/save-issue-book-data
#[GET] api/return-book-view/{id}
#[GET] api/return-book/{id}
#[GET] api/all-issed-book
#[GET] api/search-issued-book
#[GET] api/library-member
#[GET] api/library-member/create
#[POST] api/library-member
#[GET] api/library-member/{library_member}
#[GET] api/library-member/{library_member}/edit
#[PUT,PATCH] api/library-member/{library_member}
#[DELETE] api/library-member/{library_member}
#[GET] api/add-library-member
#[GET] api/library-member-role
#[GET] api/cancel-membership/{id}
#[GET] api/item-category
#[GET] api/item-category/create
#[POST] api/item-category
#[GET] api/item-category/{item_category}
#[GET] api/item-category/{item_category}/edit
#[PUT,PATCH] api/item-category/{item_category}
#[DELETE] api/item-category/{item_category}
#[GET] api/delete-item-category-view/{id}
#[GET] api/delete-item-category/{id}
#[GET] api/item-list
#[GET] api/item-list/create
#[POST] api/item-list
#[GET] api/item-list/{item_list}
#[GET] api/item-list/{item_list}/edit
#[PUT,PATCH] api/item-list/{item_list}
#[DELETE] api/item-list/{item_list}
#[GET] api/delete-item-view/{id}
#[GET] api/delete-item/{id}
#[GET] api/item-store
#[GET] api/item-store/create
#[POST] api/item-store
#[GET] api/item-store/{item_store}
#[GET] api/item-store/{item_store}/edit
#[PUT,PATCH] api/item-store/{item_store}
#[DELETE] api/item-store/{item_store}
#[GET] api/delete-store-view/{id}
#[GET] api/delete-store/{id}
#[GET] api/suppliers
#[GET] api/suppliers/create
#[POST] api/suppliers
#[GET] api/suppliers/{supplier}
#[GET] api/suppliers/{supplier}/edit
#[PUT,PATCH] api/suppliers/{supplier}
#[DELETE] api/suppliers/{supplier}
#[GET] api/delete-supplier-view/{id}
#[GET] api/delete-supplier/{id}
#[GET] api/item-issue
#[POST] api/save-item-issue-data
Skipping route: [GET] api/getItemByCategory: Controller method does not exist.
#[GET] api/return-item-view/{id}
#[GET] api/return-item/{id}
#[GET] api/transport-route
#[GET] api/transport-route/create
#[POST] api/transport-route
#[GET] api/transport-route/{transport_route}
#[GET] api/transport-route/{transport_route}/edit
#[PUT,PATCH] api/transport-route/{transport_route}
#[DELETE] api/transport-route/{transport_route}
#[GET] api/vehicle
#[GET] api/vehicle/create
#[POST] api/vehicle
#[GET] api/vehicle/{vehicle}
#[GET] api/vehicle/{vehicle}/edit
#[PUT,PATCH] api/vehicle/{vehicle}
#[DELETE] api/vehicle/{vehicle}
#[GET] api/assign-vehicle
#[GET] api/assign-vehicle/create
#[POST] api/assign-vehicle
Skipping route: [GET] api/assign-vehicle/{assign_vehicle}: Controller method does not exist.
#[GET] api/assign-vehicle/{assign_vehicle}/edit
#[PUT,PATCH] api/assign-vehicle/{assign_vehicle}
Skipping route: [DELETE] api/assign-vehicle/{assign_vehicle}: Controller method does not exist.
#[POST] api/assign-vehicle-delete
#[GET] api/student-transport-report
#[POST] api/student-transport-report
#[GET] api/room-list
#[GET] api/room-list/create
#[POST] api/room-list
#[GET] api/room-list/{room_list}
#[GET] api/room-list/{room_list}/edit
#[PUT,PATCH] api/room-list/{room_list}
#[DELETE] api/room-list/{room_list}
#[GET] api/room-type
#[GET] api/room-type/create
#[POST] api/room-type
#[GET] api/room-type/{room_type}
#[GET] api/room-type/{room_type}/edit
#[PUT,PATCH] api/room-type/{room_type}
#[DELETE] api/room-type/{room_type}
#[GET] api/dormitory-list
#[GET] api/dormitory-list/create
#[POST] api/dormitory-list
#[GET] api/dormitory-list/{dormitory_list}
#[GET] api/dormitory-list/{dormitory_list}/edit
#[PUT,PATCH] api/dormitory-list/{dormitory_list}
#[DELETE] api/dormitory-list/{dormitory_list}
#[GET] api/student-dormitory-report
#[POST] api/student-dormitory-report
#[GET] api/student-report
#[POST] api/student-report
#[GET] api/guardian-report
#[POST] api/guardian-report-search
#[GET] api/guardian-report-search
#[GET] api/student-history
#[POST] api/student-history-search
#[GET] api/student-history-search
#[GET] api/student-login-report
#[POST] api/student-login-search
#[GET] api/student-login-search
#[POST] api/reset-student-password
#[GET] api/fees-statement
#[POST] api/fees-statement-search
#[GET] api/balance-fees-report
#[POST] api/balance-fees-search
#[GET] api/balance-fees-search
#[GET] api/transaction-report
#[POST] api/transaction-report-search
#[GET] api/transaction-report-search
#[GET] api/class-report
#[POST] api/class-report
#[GET] api/class-routine-report
#[POST] api/class-routine-report
#[GET] api/exam-routine-report
#[POST] api/exam-routine-report
#[GET] api/teacher-class-routine-report
#[POST] api/teacher-class-routine-report
#[GET] api/merit-list-report
#[POST] api/merit-list-report
#[GET] api/online-exam-report
#[POST] api/online-exam-report
#[GET] api/mark-sheet-report-student
#[POST] api/mark-sheet-report-student
#[GET] api/tabulation-sheet-report
#[POST] api/tabulation-sheet-report
#[GET] api/progress-card-report
#[POST] api/progress-card-report
#[GET] api/student-fine-report
#[POST] api/student-fine-report
#[GET] api/user-log
#[GET] api/general-settings
#[GET] api/update-general-settings
#[POST] api/update-general-settings-data
#[POST] api/update-school-logo
#[GET] api/system-role
#[GET] api/role
#[POST] api/role-store
#[GET] api/role-edit/{id}
#[POST] api/role-update
#[POST] api/role-delete
#[GET] api/assign-permission/{id}
#[POST] api/role-permission-store
#[GET] api/base-group
#[POST] api/base-group-store
#[GET] api/base-group-edit/{id}
#[POST] api/base-group-update
#[GET] api/base-group-delete/{id}
#[GET] api/academic-year
Skipping route: [GET] api/academic-year/create: Controller method does not exist.
#[POST] api/academic-year
#[GET] api/academic-year/{academic_year}
#[GET] api/academic-year/{academic_year}/edit
#[PUT,PATCH] api/academic-year/{academic_year}
#[DELETE] api/academic-year/{academic_year}
#[GET] api/session
#[GET] api/session/create
#[POST] api/session
#[GET] api/session/{session}
#[GET] api/session/{session}/edit
#[PUT,PATCH] api/session/{session}
#[DELETE] api/session/{session}
#[GET] api/holiday
#[GET] api/holiday/create
#[POST] api/holiday
#[GET] api/holiday/{holiday}
#[GET] api/holiday/{holiday}/edit
#[PUT,PATCH] api/holiday/{holiday}
#[DELETE] api/holiday/{holiday}
#[GET] api/delete-holiday-view/{id}
#[GET] api/delete-holiday/{id}
#[GET] api/weekend
#[GET] api/weekend/create
#[POST] api/weekend
#[GET] api/weekend/{weekend}
#[GET] api/weekend/{weekend}/edit
#[PUT,PATCH] api/weekend/{weekend}
#[DELETE] api/weekend/{weekend}
#[GET] api/student-homework/{id}
#[GET] api/student-dashboard/{id}
#[GET] api/student-my-attendance/{id}
#[GET] api/student-noticeboard/{id}
#[GET] api/studentSubject/{id}
#[GET] api/student-library/{id}
#[GET] api/studentTeacher/{id}
#[GET] api/studentAssignment/{id}
#[GET] api/studentDocuments/{id}
#[GET] api/student-dormitory
#[GET] api/student-exam_schedule/{id}
#[GET] api/student-timeline/{id}
#[GET] api/student-online-exam/{id}
#[GET] api/choose-exam/{id}
#[GET] api/online-exam-result/{id}/{exam_id}
#[GET] api/getGrades/{marks}
#[GET] api/getSystemVersion
#[GET] api/getSystemUpdate/{id}
#[GET] api/exam-list/{id}
#[GET] api/exam-schedule/{id}/{exam_id}
#[GET] api/exam-result/{id}/{exam_id}
#[GET] api/new-exam-setup
#[GET] api/new-exam-schedule
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/change-password
#[GET] api/child-list/{id}
#[GET] api/child-info/{id}
#[GET] api/child-fees/{id}
#[GET] api/child-class-routine/{id}
#[GET] api/child-homework/{id}
#[GET] api/child-attendance/{id}
#[GET] api/childInfo/{id}
#[GET] api/parent-about
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/search-student
#[GET] api/my-routine/{id}
#[GET] api/section-routine/{id}/{class}/{section}
#[GET] api/class-section/{id}
#[GET] api/subject/{id}
#[GET] api/teacher-class-list
#[GET] api/teacher-section-list
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/add-homework
#[GET] api/homework-list/{id}
#[GET] api/my-attendance/{id}
#[GET] api/staff-leave-type
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/staff-apply-leave
#[GET] api/staff-apply-list/{id}
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/teacher-upload-content
#[GET] api/content-list/{user_id}
#[GET] api/delete-content/{id}
#[GET] api/pending-leave
#[GET] api/approved-leave
#[GET] api/reject-leave
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/staff-leave-apply
#[GET] api/update-leave
#[POST] api/update-staff
#[POST] api/update-student
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/set-token
#[GET] api/group-token
#[GET] api/room-type-list
#[GET] api/room-update
#[GET] api/room-delete/{id}
#[GET] api/add-dormitory
#[GET] api/edit-dormitory
#[GET] api/delete-dormitory/{id}
#[GET] api/driver-list
#[GET] api/student-attendance-check
#[GET] api/student-attendance-store-first
#[GET] api/student-attendance-store-second
#[GET] api/book-category
#[GET] api/download-content-document/{file_name}
#[GET] api/download-complaint-document/{file_name}
#[GET] api/download-visitor-document/{file_name}
#[GET] api/postal-receive-document/{file_name}
#[GET] api/postal-dispatch-document/{file_name}
#[POST] api/custom-merit-list
#[POST] api/custom-progress-card
#[POST] api/student-final-result
#[GET] api/user-demo
#[GET] api/currency-converter
#[GET,POST,PUT,PATCH,DELETE,OPTIONS] api/student-fees-payment
Skipping route: [GET] email-test: Closure routes are not supported.
#[GET] /
#[GET] logout
#[GET] home
#[GET] about
#[GET] course
#[GET] course-Details/{id}
#[GET] news-page
#[GET] news-details/{id}
#[GET] contact
#[GET] register
#[POST] register
Skipping route: [GET] error-404: Closure routes are not supported.
#[GET] notification-api
#[POST] search
#[GET] login
#[POST] login
#[GET] recovery/passord
#[POST] email/verify
#[GET] reset/password/{email}/{code}
#[POST] store/new/password
#[GET] login-2
#[GET] banks
#[POST] student-upload-homework
#[GET] my-leave-type/{user_id}
