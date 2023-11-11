//إظهار التنبيه
function makeTost(massage, type, time = 4000) {
    toasting.create({
        title: massage,
        type: type,
        timeout: time,
    });
}
