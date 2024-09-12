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
    const searchInput = document.getElementById('searchName'); // ใช้ช่องเดียวในการค้นหา
    const table = document.querySelector('table');
    const rows = Array.from(table.querySelectorAll('tbody tr'));

    const nameIndex = Array.from(table.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === 'ชื่อ-นามสกุล');
    const positionIndex = Array.from(table.querySelectorAll('thead th')).findIndex(th => th.textContent.trim() === 'ตำแหน่ง');

    function filterByNameOrPosition() {
        const searchValue = searchInput.value.toLowerCase().trim(); // ค่าที่จะค้นหา

        rows.forEach(row => {
            const nameCell = row.querySelectorAll('td')[nameIndex].textContent.toLowerCase().trim();
            const positionCell = row.querySelectorAll('td')[positionIndex].textContent.toLowerCase().trim();

            // แสดงแถวถ้าชื่อ-นามสกุลหรือตำแหน่งตรงกับคำค้นหา
            if (nameCell.includes(searchValue) || positionCell.includes(searchValue)) {
                row.style.display = ''; // แสดงแถว
            } else {
                row.style.display = 'none'; // ซ่อนแถว
            }
        });
    }

    searchInput.addEventListener('input', filterByNameOrPosition);
});






 