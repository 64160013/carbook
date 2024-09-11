 /**
     *
     *
     * 
     */
// ---------------------เช็ค division and departmen ของ register---------------------
document.addEventListener('DOMContentLoaded', function () {
    const divisionSelect = document.getElementById('division');
    const departmentGroup = document.getElementById('department-group');
    const departmentSelect = document.getElementById('department');

    // ฟังก์ชันตรวจสอบค่า division
    function toggleDepartmentField() {
        console.log('Selected division:', divisionSelect.value); // ตรวจสอบค่า division
        if (divisionSelect.value == '2') {
            departmentGroup.style.display = 'block'; // แสดงฟิลด์ฝ่ายงาน
        } else {
            departmentGroup.style.display = 'none'; // ซ่อนฟิลด์ฝ่ายงาน
            departmentSelect.value = ''; // เคลียร์ค่าเมื่อซ่อนฝ่ายงาน
        }
    }

    toggleDepartmentField(); // เรียกฟังก์ชันเมื่อหน้าโหลดขึ้นมา (เพื่อตรวจสอบค่าเก่า)

    // เรียกฟังก์ชันเมื่อเปลี่ยนค่าใน dropdown
    divisionSelect.addEventListener('change', toggleDepartmentField);
});


/**
     *
     *
     * 
     */
// ---------------------ค้นหาด้วยชื่อ นามสกุล---------------------
document.addEventListener('DOMContentLoaded', function () {
    const searchName = document.getElementById('searchName');
    const table = document.querySelector('table');
    const rows = Array.from(table.querySelectorAll('tbody tr'));

    const nameIndex = Array.from(table.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === 'ชื่อ-นามสกุล');
    
    function filterByName() {
        const searchValue = searchName.value.toLowerCase().trim();

        rows.forEach(row => {
            const nameCell = row.querySelectorAll('td')[nameIndex].textContent.toLowerCase().trim();
            
            // แสดงแถวที่ตรงกับคำค้นหาหรือซ่อนแถวที่ไม่ตรง
            if (nameCell.includes(searchValue)) {
                row.style.display = ''; // แสดงแถว
            } else {
                row.style.display = 'none'; // ซ่อนแถว
            }
        });
    }

    searchName.addEventListener('input', filterByName);
});


 /**
     *
     *
     * 
     */
// ---------------------ค้นหาผู้ใช้ผานตัวกรอง---------------------
document.addEventListener('DOMContentLoaded', function () {
    const filterDivision = document.getElementById('filterDivision');
    const filterDepartment = document.getElementById('filterDepartment');
    const filterPosition = document.getElementById('filterPosition');
    const filterRole = document.getElementById('filterRole');
    const table = document.querySelector('table');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    
    // หา index ของแต่ละคอลัมน์
    const divisionIndex = Array.from(table.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === 'ส่วนงาน');
    const departmentIndex = Array.from(table.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === 'ฝ่ายงาน');
    const positionIndex = Array.from(table.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === 'ตำแหน่ง');
    const roleIndex = Array.from(table.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === 'Role');

    function filterTable() {
        const divisionValue = filterDivision.value.trim();
        const departmentValue = filterDepartment.value.trim();
        const positionValue = filterPosition.value.trim();
        const roleValue = filterRole.value.trim();

        rows.forEach(row => {
            const divisionCell = row.querySelectorAll('td')[divisionIndex].textContent.trim();
            const departmentCell = row.querySelectorAll('td')[departmentIndex].textContent.trim();
            const positionCell = row.querySelectorAll('td')[positionIndex].textContent.trim();
            const roleCell = row.querySelectorAll('td')[roleIndex].textContent.trim();

            const divisionMatch = !divisionValue || divisionCell === divisionValue;
            const departmentMatch = !departmentValue || departmentCell === departmentValue;
            const positionMatch = !positionValue || positionCell === positionValue;
            const roleMatch = !roleValue || roleCell === roleValue;

            if (divisionMatch && departmentMatch && positionMatch && roleMatch) {
                row.style.display = ''; // แสดงแถวที่ตรงกับตัวกรอง
            } else {
                row.style.display = 'none'; // ซ่อน
            }
        });
    }

    filterDivision.addEventListener('change', filterTable);
    filterDepartment.addEventListener('change', filterTable);
    filterPosition.addEventListener('change', filterTable);
    filterRole.addEventListener('change', filterTable);
});


 