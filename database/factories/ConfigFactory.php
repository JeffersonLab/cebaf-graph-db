<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Config>
 */
class ConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'yaml' => $this->yaml(),
            'comments' => $this->faker->text(),
        ];
    }

    protected function yaml(){
        $yaml = <<<EOD
---
ced:
  history: true           # Optional.  Default is false meaning use OPS ced.
  workspace: '2021-12-15' # Optional.  Default is OPS workspace/current timestamp
  zone: "Injector"        # Required.  See https://ced.acc.jlab.org/zones/
  types: ["LineElem"]     # Required.  See https://ced.acc.jlab.org/catalog/
  properties: []          # Optional.  Specify properties in addition to default EPICSName and S
  expressions:
    - S >= 6.65657  # skip over elements in the front of the MFA0I03 S Value
    - S <= 101.58   # So that ILM0R08 is final element
nodes:

  master:
    - IBC0L02Current     # must also be present in mya.global

  setpoints:
    Corrector: [".BDL", ".S"]
    Dipole: [".BDL", ".S"]
    Quad: [".BDL", ".S"]
    Solenoid: [".BDL", ".S"]
    CryoCavity: ['PSET','GSET','XPSET8']
    Capture: ['PSET','GSET']
    WarmCavity: ['PSET','GSET','Psum']

  readbacks:
    BeamLossMonitor: ["Lc"]
    BPM: [".XPOS", ".YPOS", ""] # The "" is to give us a bare EPICSName which means the wire sum
    IonPump: [""]               # The "" is the vacuum readback
    BCM: [""]                   # node module must handle special cases

  default_attributes:
    BCM: "Current"      # The bare EPICSName of a BCM gives us its Current
    BPM: "WireSum"      # The bare EPICSName of a BPM is its WireSum
    IonPump: "Vacuum"   #

  modifiers:
    VINJDIG07: "0.066 * $(VINJDIG07) * 0.000001 *((5600/5600)/80)"
    VINJDIG02: "0.066 * $(VINJDIG02) * 0.000001 *((5600/5600)/120)"
    VINJDIG03: "0.066 * $(VINJDIG03) * 0.000001 *((5600/5600)/102)"
    VINJDIG04: "0.066 * $(VINJDIG04) * 0.000001 *((5600/5600)/160)"
    VINJDIG12: "0.066 * $(VINJDIG12) * 0.000001 *((5600/5600)/45)"
    VINJDIG08: "0.066 * $(VINJDIG08) * 0.000001 *((5600/5600)/30)"
    VINJDIG05: "0.066 * $(VINJDIG05) * 0.000001 *((5600/5600)/120)"
    VINJDIG06: "0.066 * $(VINJDIG06) * 0.000001 *((5600/5600)/120)"
    filter: "$(IBC0L02Current) > 0.1"

mya:
  deployment: "history"
  throttle: 2500
  dates:
    begin:
    end:
    interval: 1h
  global:
    - ISD0I011G
    - BOOMHLAMODE
    - BOOMHLBMODE
    - BOOMHLCMODE
    - BOOMHLDMODE
    - IBC0L02Current
    - IBC0R08CRCUR1
    - IBC1H04CRCUR2
    - IBC2C24CRCUR3
    - IBC3H00CRCUR4
    - IBCAD00CRCUR6
    - IGL1I00BEAMODE
    - IGL1I00HALLAMODE
    - IGL1I00HALLBMODE
    - IGL1I00HALLCMODE
    - IGL1I00HALLDMODE

edges:
  connectivity: 5
  directed: true      # Probably stays true since the beam is directional
  weighted: false

output:
  structure: directory
  minutes: false
  seconds: false

EOD;
    return $yaml;
    }

}
