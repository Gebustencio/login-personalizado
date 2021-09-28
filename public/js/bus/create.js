let $doctor,$especialidad,$date,$hours;
let iRadio;
const noHoursAlert =`<div class="alert alert-danger" role="alert">
<strong>Lo sentimos!</strong> no se encontraron horas disponibles
</div>`;
$(function(){
    $especialidad =$('#especialidad');
    $doctor = $('#doctor');
     $date=$('#date');
     $hours=$('#hours');

    $especialidad.change(()=>{
        const especialidadId=$especialidad.val();
        const url=`./especialidades/${especialidadId}/doctores`;
        $.getJSON(url,onDoctoresLoaded);

    });
    $doctor.change(loadHours);
    $date.change(loadHours);
});
function onDoctoresLoaded(doctores){
    let htmlOptions = '';
    doctores.forEach(doctor => {
        htmlOptions +=`<option value="${doctor.id}">${doctor.name}</option>` ;
    });
    $doctor.html(htmlOptions);
    loadHours();
}
function loadHours()
{   const selectedDate=$date.val();
    const doctorId=$doctor.val();
    const url=`./schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url,displayHours);

}

function displayHours(data)
{
    if(!data.morning && !data.afternoon)
    {
        $hours.html(noHoursAlert);
        return;
    }
    let htmlHours='';
    iRadio=0;
    if(data.morning)
    {
        const morning_intervals=data.morning;
        morning_intervals.forEach(interval=>{
         htmlHours +=getRadioIntervalHtml(interval);
        });
    }
    if(data.afternoon)
    {
        const afternoon_intervals=data.afternoon;
         afternoon_intervals.forEach(interval=>{
          htmlHours +=getRadioIntervalHtml(interval);
        });
    }
    $hours.html(htmlHours);
}

function getRadioIntervalHtml(interval)
{
    const text=`${interval.start} - ${interval.end}`;

    return `<div class="custom-control custom-radio mb-3">
    <input  name="hora_programacion" value="${interval.start}" class="custom-control-input" id="interval${iRadio}" type="radio" value="${text}" required >
    <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
  </div>`;
}
