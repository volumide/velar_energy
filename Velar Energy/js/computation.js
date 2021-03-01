let all = []
let types = []
let allaccesories = []
let loads = []
let qoutation = []

// calling accesories based on category clicked 
fetch('http://aitechma-dev.com.ng/velar_backend/getaccessories.php')
    .then((data) => data.json())
    .then((res) => {
        allaccesories = res['data']
        // console.log(res)
    })

//get the category from the database
fetch('http://aitechma-dev.com.ng/velar_backend/get.php')
    .then((data) => data.json())
    .then((res) => {
        all.push(...res['data'])
        let select = document.getElementById('select')
        let category = document.getElementById('accordion')
        let output = ''
        all.map(responds => {
            types.push(responds['load-type'])
        })
        for (let i = 0; i < types.length; i++) {
            let text = types[i]
            let opt = document.createElement('option')
            opt.text = text
            opt.value = text
            try {
                select.appendChild(opt)
            } catch{
                output += `
                <div class="card rounded-0">
                    <div class="card-header  id="headingOne"  style="background: #35B729;">
                        <!-- <h2 class="mb-0"> -->
                        <button style="color:#fff;" class="btn collapsed text-uppercase font-weight-bold btn-block rounded-0" type="button" data-toggle="collapse"
                            data-target="#${text.split(' ').join('')}" aria-expanded="true" aria-controls="${text}">
                            ${text}
                        </button>
                    </div>
                
            `
                // <div class='types'> ${text} </div>`
                let val = allaccesories.filter(data => data.category.toLowerCase() === text.toLowerCase())
                for (let i = 0; i < val.length; i++) {
                    output += `
                <div id="${text.split(' ').join('')}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                    <div class="row">
                            <div class="col-4 font-weight-bold">
                            ${val[i].name} 
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="number" inputmode="numeric" data-watts =  ${val[i].watts}  id="${val[i].name}" class="form-control input form-control-lg rounded-0" placeholder="Total number of ${val[i].name}" aria-describedby="helpId">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                    // <div onclick = 'console.log(this.getAttribute("data-watts"))' style="background:yellow;"  data-watts =  ${val[i].watts}> 
                    //     ${val[i].name} 
                    // </div>
                    // <div class='include'>
                    //     <input type="number" class='input' data-watts =  ${val[i].watts} id ='${val[i].name}'  placeholder= 'Total number of ${val[i].name}'>
                    // </div>
                    // `
                }
                output += '</div>'
            }

        }
        category.innerHTML = output
        // console.log(types)
        // console.log(sub)
    })
    .catch(err => {
        console.log(err)
    })


fetch('http://aitechma-dev.com.ng/velar_backend/getestimate.php')
    .then(data => data.json())
    .then(res => qoutation = res['data'])

// get accessories
function getAccessories(ev) {
    // console.log(ev)
    let tag = ev
    let accesories = document.getElementById('accesories')
    let output = ''
    let val = allaccesories.filter(data => data.category.toLowerCase() === tag.toLowerCase())
    for (let i = 0; i < val.length; i++) {
        output += `
        <div onclick = 'console.log(this.getAttribute("data-watts"))' class='types'  data-watts =  ${val[i].watts}> 
            ${val[i].name} 
        </div>
        <div class='include'>
            <input type="number" class='input' data-watts =  ${val[i].watts} id ='${val[i].name}'  placeholder= 'Total number of ${val[i].name}'>
        </div>
        `
    }
    output += `<div> <button onclick ='addToEstimate()'>Add to List </button>`
    //accesories.innerHTML = output
}


//add category and accessories to database 
function addAccessories() {
    let name = document.getElementById('name').value
    let watts = document.getElementById('watts').value
    let type = document.getElementById('select').value
    fetch('http://aitechma-dev.com.ng/velar_backend/create.php', {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            name: name,
            type: type,
            watts: watts
        })
    })
        .then((res) => res.json())
        .then((res) => console.log(res))
        .catch((err) => console.log(err))
}


//adding estimate to list
function addToEstimate() {
    let input = document.querySelectorAll('.input')
    let estimate = document.getElementById('estimate')
    let output = ''
    // let arr = []
    if (loads) {
        loads = []
    }
    input.forEach(inputs => {
        if (inputs.value != '') {
            loads.push({
                "name": inputs.id,
                "number": inputs.value,
                "watts": inputs.getAttribute('data-watts'),
                "load": (inputs.value * inputs.getAttribute('data-watts'))
            })
        }
    })
    console.log(loads)
    calculatekva()
}

//compute estimate 
function getEstimate(){
    
}


//calculate and estimate the load collected 
function calculatekva() {
    //standard kva
    let standardkva = [0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 5, 6, 6.5, 7.5, 10]
    let powerFactor = 0.8
    let kconstant = 1000
    let vconstant = 220
    let batterydodconstant = 0.5
    let batteryefficiencyconstant = 0.8
    let standardbatteryamp = 200
    let standardbatterycurrent = 12
    let batterycurrent = standardbatteryamp * standardbatterycurrent

    let collecteddata = []
    collecteddata = loads.map(data => data.load)

    //kva calculation
    let accumlatedload = collecteddata.reduce((a, b) => a + b)
    let kw = accumlatedload / 1000

    let load = kw / powerFactor
    let efficinency = load / 0.7
    let invertedkva = Number(efficinency).toFixed(2)

    //inverted kva round up
    if (invertedkva < 0.5 || invertedkva < .7) {
        invertedkva = standardkva[0] //.5
    } else if (invertedkva > 0.7 && invertedkva <= 1.3) {
        invertedkva = standardkva[1] //.1
    } else if (invertedkva > 1.3 && invertedkva <= 1.7) {
        invertedkva = standardkva[2] //1.5
    } else if (invertedkva > 1.7 && invertedkva <= 2.4) {
        invertedkva = standardkva[3] //2
    } else if (invertedkva > 2.4 && invertedkva <= 2.6) {
        invertedkva = standardkva[4] //2.5
    } else if (invertedkva > 2.6 && invertedkva <= 3.3) {
        invertedkva = standardkva[5] //3
    } else if (invertedkva > 3.3 && invertedkva <= 3.6) {
        invertedkva = standardkva[6] //3.5
    } else if (invertedkva > 3.6 && invertedkva <= 4.4) {
        invertedkva = standardkva[7] //4
    } else if (invertedkva > 4.4 && invertedkva <= 5.3) {
        invertedkva = standardkva[8] //5
    } else if (invertedkva > 5.3 && invertedkva <= 6.3) {
        invertedkva = standardkva[9] //6
    } else if (invertedkva > 6.3 && invertedkva <= 6.9) {
        invertedkva = standardkva[10] //6.5
    } else if (invertedkva > 6.9 && invertedkva <= 8.6) {
        invertedkva = standardkva[11] //7.5
    } else if (invertedkva > 8.7) {
        invertedkva = standardkva[12] //10
    }



    //the estimation calculation for invoice
    let systemcurrent = (kconstant * invertedkva) / vconstant
    let estimate = qoutation.filter(data => data.kva === invertedkva.toString())

    document.getElementById('efficiency').innerHTML = efficinency
    document.getElementById('kva').innerHTML = invertedkva
    document.getElementById('load').innerHTML = load
    return invertedkva
    
}

function getbattery() {
    //battery needed
    let hoursofusage = document.getElementById('hrs').value
    let name  = document.getElementById('name').value
    let phone = document.getElementById('phone').value
    let email = document.getElementById('email').value
    let usageaddress = document.getElementById('usage').value

    let username = document.getElementById('username')
    let address = document.getElementById('address')
    let usermail = document.getElementById('useremail')
    let userphone = document.getElementById('userphone')
    let date = document.getElementById('date')
    let id = document.getElementById('qouteid')
    let duedate = document.getElementById('duedate')
    let hoursofuse = document.getElementById('hoursofuse')
    let userkva = document.getElementById('userkva')
    let volt = document.getElementById('volt')
    let amp = document.getElementById('amp')
    let solarcharge = document.getElementById('solarcharge')
    let batteryqty = document.getElementById('batteryqty')
    let inverterprice = document.getElementById('inverterprice')
    let batteryprice = document.getElementById('batteryprice')
    let no_solar = document.getElementById('nosolar')
    let panelprice = document.getElementById('panelprice')
    let solarprice = document.getElementById('solarprice')
    let solarstore = document.getElementById('solarstorepric')
    let totalwithoutsolar = document.getElementById('twithoutsolar')
    let totalwithsolar = document.getElementById('twithsolar')
    let kva = calculatekva()
    if (name == '' || phone == '' ||  email =='' || usageaddress =='' || hoursofusage =='') {
        alert("Every Informaton is necessary")
        return
    }

    fetch('http://aitechma-dev.com.ng/velar_backend/getestimate.php')
    .then(data => data.json())
    .then(res => qoutation = res['data'])
    let qoute = qoutation.filter(data => data.kva === kva.toString()).filter(res => res.hours === hoursofusage)['0']
    
    // document.querySelector('table').
    // username.innerHTML = name
    // usermail.innerHTML = email
    // address.innerHTML = usageaddress
    // userphone.innerHTML = phone
    hoursofuse.innerHTML = hoursofusage
    userkva.innerHTML = qoute.kva
    volt.innerHTML = qoute.voltage
    amp.innerHTML = qoute.amp
    solarcharge.innerHTML = qoute.solar_charge
    batteryqty.innerHTML = qoute.battery_quantity
    inverterprice.innerHTML = qoute.inverter_price
    panelprice.innerHTML = qoute.panel_price
    solarprice.innerHTML = qoute.solar_price
    batteryprice.innerHTML = qoute.battery_price
    no_solar.innerHTML = qoute.no_solar_store
    solarstore.innerHTML = qoute.solar_store
    let totalswithsolar = Number(qoute.battery_price) + Number(qoute.inverter_price) + Number(qoute.no_solar_store)

    let totalswithoutsolar = Number(qoute.battery_price) + Number(qoute.inverter_price) + (Number(qoute.panel_price) * Number(qoute.pannel_needed)) + Number(qoute.solar_price) + Number(qoute.solar_store)
    console.log(qoute)

    totalwithoutsolar.innerHTML = totalswithoutsolar
    totalwithsolar.innerHTML = totalswithsolar



}

function preview(){
    document.getElementById('qouter').style.display = 'block'

    let pdf = new jsPDF('p', 'pt', 'a4');
    pdf.setFontSize(12);
    pdf.fromHTML(document.getElementById('qouter'),
    30,30)
    var iframe = document.createElement('iframe');
    iframe.setAttribute('style', 'position:absolute;right:0; transform: translate(-50%)top:0; bottom:0; height:100%; width:100%; box-sizing:border-box; padding:20px;');
    document.body.appendChild(iframe);
    iframe.src = pdf.output('datauristring');

    document.getElementById('qouter').style.display = 'none'

}

/*
loads.map(data => {
    output += `
        <div style="padding: 10px;">
            <h4> ${data.name} </h4>
            <p> Total Number : ${data.number} <p>
            <p "> Total Load : ${data.load} </p>
        </div>
    `
})

output += '<input type= "number" placeholder="maximum hours of usage" id="hrs">'
output += '<button onclick= "estimate()" > Get Estimate </button>'
estimate.innerHTML = output\


let hoursofusage = document.getElementById('hrs').value;

validating hours usage
if (hoursofusage == null || hoursofusage == '') {
    alert('Hours of usage can\'t be null')
    return
}else if (hoursofusage > 24) {
    alert(' maximum hours of usage is 24')
    return
}else if (hoursofusage < 0) {
    alert('maximum hours of usage cannot be negative')
    return
}
storing the collected data

let systemcapacity = systemcurrent * hoursofusage
let batterydod = systemcapacity/batterydodconstant
let batteryefficieny = batterydod/batteryefficiencyconstant
let batteryneeded = Math.round(batteryefficieny)

for 24 volts 
let need = batteryefficieny * 24
let battery24volt = Math.round(need/batterycurrent)

system energey
let systemenergy = batteryneeded * 24

pannel needed calculation
let pannelwatts = 300
let sunhrs = 4.5
let pannelenergy = pannelwatts * sunhrs
let pannelneeded = Math.round(systemenergy / pannelenergy)

solar charge controller
let pannelvolt = 36
let pannelamp = pannelwatts/pannelvolt
let solarchargecontrollerneeded = Math.round(pannelneeded * pannelamp) 
let val = allaccesories.filter(data => data.category.toLowerCase() === tag.toLowerCase()) */