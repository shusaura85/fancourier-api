# Equivalent names

This table shows the FAN Courier documentation sections in the first column and the equivalent PHP API objects in the next columns

All PHP classes are relative to the `Fancourier\` namespace.


|FAN Courier Docs         |PHP Request/Response                      |PHP Object                   |Notes                               |
|-------------------------|------------------------------------------|-----------------------------|------------------------------------|
|Autentificare            |`\Auth`                                   |*\<none\>*                   |No need to create or call manually  |
|**Generare AWB**         |                                          |                             |                                    |
|Tipuri servicii          |`[Request/Response]\GetServices`          |`Objects\Service`            |No need to manually create request object. Just call `Fancourier::getServices()` |
|Optiuni servicii         |`[Request/Response]\GetServiceOptions`    |`Objects\ServiceOption`      |---                                 |
|Printare AWB             |`[Request/Response]\PrintAwb`             |*\<none\>*                   | Calling **getData()** on it will return the HTML, PDF or ZPL file data |
|Stergere AWB             |`[Request/Response]\DeleteAwb`            |*\<none\>*                   |---                                 |
|**AWB Intern**           |                                          |                             |                                    |
|Creare AWB Intern        |`[Request/Response]\CreateAwb`            |`Objects\AwbIntern`          |Used for both single and bulk AWB creation. AWB information is set via the object. The request object takes AwbIntern objects. |
|Judete                   |`[Request/Response]\GetCounties`          |`Objects\County`             |No need to manually create request object. Just call `Fancourier::getCounties()` |
|Localitati               |`[Request/Response]\GetCities`            |`Objects\City`               |---                                 |
|Strazi                   |`[Request/Response]\GetStreets`           |`Objects\Street`             |---                                 |
|Puncte PUDO              |`[Request/Response]\GetPudo`              |`Objects\Pudo`               |For FANBox. Returns list of lockers available for FANBox deliveries |
|Tarif AWB Intern         |`[Request/Response]\GetCosts`             |*\<none\>*                   |---                                 |
|**AWB Extern**           |                                          |                             |                                    |
|Creare AWB Extern        |`[Request/Response]\CreateAwbExternal`    |`Objects\AwbExtern`          |Used for both single and bulk AWB creation. AWB information is set via the object. The request object takes AwbExtern objects. |
|Tari                     |`[Request/Response]\GetCountries`         |`Objects\Country`            |No need to manually create request object. Just call `Fancourier::getCountries()` |
|Judete Externe           |`[Request/Response]\GetCountiesExternal`  |`Objects\CountyExternal`     |Works only for the following countries: Moldova, Grecia, Bulgaria |
|Localitati Externe       |`[Request/Response]\GetCitiesExternal`    |`Objects\CityExternal`       |Works only for the following countries: Moldova, Grecia, Bulgaria |
|Tarif AWB Export         |`[Request/Response]\GetCostsExternal`     |*\<none\>*                   |---                                 |
|**Comanda Curier**       |                                          |                             |                                    |
|Plasare Comanda Curier   |`[Request/Response]\CreateCourierOrder`   |*\<none\>*                   |---                                 |
|Stergere Comanda Curier  |`[Request/Response]\DeleteCourierOrder`   |*\<none\>*                   |---                                 |
|**Raportare AWB**        |                                          |                             |                                    |
|Borderou                 |`[Request/Response]\GetShippingSlip`      |`Objects\ShippingSlip`       |---                                 |
|Event-uri AWB            |`[Request/Response]\GetAwbEvents`         |`Objects\AwbEvent`           |---                                 |
|AWB Tracking             |`[Request/Response]\TrackAwb`             |`Objects\AwbTracker`         |Get tracking information for 1 or more AWBs |
|AWB Confirmations        |`[Request/Response]\GetAwbConfirmations`  |`Objects\GetAwbConfirmations` |Get delivery confirmations for 1 or more AWBs |
|Viramente Bancare        |`[Request/Response]\GetBankTransfer`      |`Objects\BankTransfer`       |---                                 |
|**Raportare Comenzi**    |                                          |                             |                                    |
|Raport Comenzi           |`[Request/Response]\GetCourierOrders`     |`Objects\CourierOrder`       |---                                 |
|Event-uri Comenzi Curier |`[Request/Response]\GetCourierOrderEvents`|`Objects\CourierOrderEvent`  |---                                 |
|Tracking Comenzi Curier  |`[Request/Response]\TrackCourierOrder`    |`Objects\CourierOrderTracker`|---                                 |
|**Detalii Cont**         |                                          |                             |                                    |
|Sucursale                |`[Request/Response]\GetBranches`          |`Objects\Branch`             |---                                 |


