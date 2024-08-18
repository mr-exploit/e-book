// Header
function updateDateToday() {
    const now = new Date();
    const days = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
    const months = [
        "01",
        "02",
        "03",
        "04",
        "05",
        "06",
        "07",
        "08",
        "09",
        "10",
        "11",
        "12",
    ];
    const day = days[now.getDay()];
    const date = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();

    const dateTodayStr = `${day}, ${date}-${month}-${year}`;
    $("#dateToday").text(dateTodayStr);
}

// Header
function updateTimeToday() {
    const now = new Date();
    let hours = now.getHours();
    const minutes = now.getMinutes();
    const ampm = hours >= 12 ? "PM" : "AM";

    // Konversi jam ke format 12 jam
    hours %= 12;
    hours = hours || 12;

    const timeTodayStr = `${hours}:${
        minutes < 10 ? "0" : ""
    }${minutes} ${ampm}`;
    $("#timeToday").text(timeTodayStr);
}

// Main Content
function lastUpdate() {
    const now = new Date();
    const days = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
    const months = [
        "01",
        "02",
        "03",
        "04",
        "05",
        "06",
        "07",
        "08",
        "09",
        "10",
        "11",
        "12",
    ];
    const day = days[now.getDay()];
    const date = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();
    let hours = now.getHours();
    const minutes = now.getMinutes();
    const ampm = hours >= 12 ? "PM" : "AM";

    // Konversi jam ke format 12 jam
    hours %= 12;
    hours = hours || 12;

    const lastUpdate = `${date}-${month}-${year} ${hours}:${
        minutes < 10 ? "0" : ""
    }${minutes} ${ampm}`;
    $("#lastUpdate").text(lastUpdate);
}

// Section Chart Daily
function chartDaily() {
    const now = new Date();
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    const date = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();

    const dateTodayStr = `${date}-${month}-${year}`;
    $("#dateChartDaily").text(dateTodayStr);
}

// Section Total Line Achievement
function totalLineAchievement() {
    const now = new Date();
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    const date = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();

    const dateTodayStr = `${date} ${month} ${year}`;
    $("#dateTotalLineAchievement").text(dateTodayStr);
}

// Panggil fungsi pertama kali
updateDateToday();
updateTimeToday();
lastUpdate();
chartDaily();
totalLineAchievement();

// Update setiap detik
setInterval(updateDateToday, 1000);
setInterval(updateTimeToday, 1000);
setInterval(lastUpdate, 1000);
setInterval(chartDaily, 1000);
setInterval(totalLineAchievement, 1000);
