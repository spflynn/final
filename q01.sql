select concat(tblCourses.fldDepartment," ",tblCourses.fldCourseNumber) as Courses,
tblCourses.fldCourseName, tblSemesterPlan.fldDisplayOrder, tblSemesterPlan.fldYear
, tblSemesterPlan.fldTerm, tblSemesterPlanCourses.fldNumCredits from tblFourYearPlan
join tblSemesterPlan on pmkPlanId=fnkPlanId
join tblSemesterPlanCourses on pmkPlanId = tblSemesterPlanCourses.fnkPlanId 
and tblSemesterPlan.fldTerm = tblSemesterPlanCourses.fldTerm
and tblSemesterPlan.fldYear = tblSemesterPlanCourses.fldYear
join tblCourses on pmkCourseId = tblSemesterPlanCourses.fnkCourseId
ORDER BY tblSemesterPlan.fldDisplayOrder, tblSemesterPlanCourses.fldDisplayOrder