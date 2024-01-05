<?php

namespace App\Livewire\Resi;

use App\Models\Container;
use App\Models\Customer;
use App\Models\Item;
use App\Models\ResiModel;
use App\Models\Setting;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Livewire\Component;

class ResiUpdate extends Component
{
    public $resi_id, $tipe_muatan, $kapal_muatan, $no_resi, $nama_pengirim, $nama_penerima, $trip_tujuan, $kota_keberangkatan, $kota_tujuan, $tgl_berangkat, $tgl_serah_barang;
    public $formFields = [];
    public $barangFields = [];
    public $customers, $setting;
    public $selectedItem;
    public $value_id, $modelValue;
    public $itemId;
    protected $listeners = ['selectOption'];

    public $deletedItems = [];

    protected $validationAttributes = [
        'trip_tujuan' => 'Trip ke berapa',
        'formFields.*.attributes.no_container' => 'No Container',
        'formFields.*.attributes.no_seal' => 'No Seal',
        'formFields.*.attributes.asal_barang' => 'Nama Pengirim',
        'formFields.*.attributes.tgl_serah_barang' => 'Tanggal Serah Barang',
        'barangFields.*.*.attributes.nama_barang' => 'Nama Barang',
        'barangFields.*.*.attributes.jml_barang' => 'Jumlah Barang',
        'barangFields.*.*.attributes.satuan_barang' => 'Satuan Barang',
        'barangFields.*.*.attributes.kg' => 'Kg',
        'barangFields.*.*.attributes.p' => 'P',
        'barangFields.*.*.attributes.l' => 'L',
        'barangFields.*.*.attributes.t' => 'T',
        'barangFields.*.*.attributes.jumlah_kubikasi' => 'Jumlah Kubikasi',
    ];

    public function selectOption($nama)
    {

        // Assuming $nama['field'] is something like "formFields.0.attributes.asal_barang"
        $fieldSegments = explode('.', $nama['field']);
        // Check if the expected structure is present
        if (count($fieldSegments) === 4 && $fieldSegments[0] === 'formFields' && is_numeric($fieldSegments[1]) && $fieldSegments[2] === 'attributes') {
            $index = (int) $fieldSegments[1];
            $attributeName = $fieldSegments[3];

            // Check if the index is within the array bounds
            if (isset($this->formFields[$index])) {
                // Set the value dynamically
                $this->formFields[$index]['attributes'][$attributeName] = $nama['value'];
            }
        } else {
            $this->{$nama['field']} = $nama['value'];

        }

    }

    public function mount($id)
    {
        $resi = ResiModel::findOrFail($id);

        $this->resi_id = $resi->id;
        $this->no_resi = $resi->no_resi;
        $this->tipe_muatan = $resi->tipe_muatan;
        $this->nama_penerima = $resi->nama_penerima;
        $this->trip_tujuan = $resi->trip_ke;
        $this->kapal_muatan = $resi->kapal_muatan;
        $this->kota_keberangkatan = $resi->kota_keberangkatan;
        $this->kota_tujuan = $resi->kota_tujuan;
        $this->tgl_berangkat = $resi->tgl_berangkat;



        $this->customers = Customer::all();
        // Fetch and set the value of $setting
        $this->setting = Setting::findOrFail(1);
        // Load related data for formFields and barangFields
        $this->loadFormFields();
        $this->loadBarangFields();


        // dd($this);
    }

    public function render()
    {
        // $this->dispatch('selectOption', ['field' => $this->selectedItem, 'value' => $this->selectedItem]);

        return view('livewire.resi.resi-update');
    }

    public function loadFormFields()
    {
        // Load formFields data based on $this->resi_id
        $containers = Container::where('resi_id', $this->resi_id)->get();

        foreach ($containers as $container) {
            $this->formFields[] = [
                'id' => $container->id,
                'attributes' => [
                    'no_container' => $container->no_container,
                    'no_seal' => $container->no_seal,
                    'asal_barang' => $container->asal_barang,
                    'tgl_serah_barang' => $container->tgl_serah_barang,
                ],
            ];
        }
    }

    public function loadBarangFields()
    {
        // Load barangFields data based on $this->resi_id
        foreach ($this->formFields as $formField) {
            $items = Item::where('container_id', $formField['id'])->get();

            $this->barangFields[$formField['id']] = [];

            foreach ($items as $item) {
                $this->barangFields[$formField['id']][] = [
                    'id' => uniqid(),
                    'attributes' => [
                        'id' => $item->id,
                        'nama_barang' => $item->nama_barang,
                        'jml_barang' => $item->jml_barang,
                        'satuan_barang' => $item->satuan_barang,
                        'kg' => $item->kg,
                        'p' => $item->p,
                        'l' => $item->l,
                        't' => $item->t,
                        'jumlah_kubikasi' => $item->jumlah_kubikasi,
                    ],
                ];
            }
        }
    }

    public function calculateJumlahKubikasi($formFieldId, $index)
    {
        // Check if the array and the keys exist before accessing them
        if (
            isset($this->barangFields[$formFieldId][$index]['attributes']['p']) &&
            isset($this->barangFields[$formFieldId][$index]['attributes']['l']) &&
            isset($this->barangFields[$formFieldId][$index]['attributes']['t'])
        ) {
            $p = $this->barangFields[$formFieldId][$index]['attributes']['p'];
            $l = $this->barangFields[$formFieldId][$index]['attributes']['l'];
            $t = $this->barangFields[$formFieldId][$index]['attributes']['t'];

            // Calculate jumlah_kubikasi based on p, l, and t
            $jumlahKubikasi = $p * $l * $t;

            // Update the value in the Livewire data array
            $this->barangFields[$formFieldId][$index]['attributes']['jumlah_kubikasi'] = $jumlahKubikasi;
        }
    }

    public function update()
    {
        $this->validate([
            'no_resi' => 'required',
            'nama_penerima' => 'required',
            'trip_tujuan' => 'required',
            'kota_keberangkatan' => 'required',
            'kota_tujuan' => 'required',
            'kapal_muatan' => 'required',
            'tgl_berangkat' => 'required',
            'tipe_muatan' => 'required',
            'formFields.*.attributes.no_container' => 'required',
            'formFields.*.attributes.no_seal' => 'required',
            'formFields.*.attributes.asal_barang' => 'required',
            'formFields.*.attributes.tgl_serah_barang' => 'required',
            'barangFields.*.*.attributes.nama_barang' => 'required',
            'barangFields.*.*.attributes.jml_barang' => 'required|numeric',
            'barangFields.*.*.attributes.satuan_barang' => 'required',
            // 'barangFields.*.*.attributes.kg' => 'required',
            'barangFields.*.*.attributes.p' => 'required|numeric',
            'barangFields.*.*.attributes.l' => 'required|numeric',
            'barangFields.*.*.attributes.t' => 'required|numeric',
            'barangFields.*.*.attributes.jumlah_kubikasi' => 'required|numeric',
            // Add more fields as needed
        ]);
        try {


            $resi_data = [
                'no_resi' => $this->no_resi,
                'customer_id' => 1,
                'setting_id' => 1,
                'tipe_muatan' => $this->tipe_muatan,
                'kapal_muatan' => $this->kapal_muatan,
                'nama_penerima' => $this->nama_penerima,
                'trip_ke' => $this->trip_tujuan,
                'kota_keberangkatan' => $this->kota_keberangkatan,
                'kota_tujuan' => $this->kota_tujuan,
                'tgl_berangkat' => $this->tgl_berangkat,
            ];

            // Use updateOrCreate to create or update the ResiModel
            $resi = ResiModel::updateOrCreate(['id' => $this->resi_id], $resi_data);
            $resiId = $resi->id;

            $totalJumlahKubikasi = 0; // Initialize the total

            foreach ($this->formFields as $formField) {
                $container = Container::updateOrCreate(
                    ['resi_id' => $resiId, 'no_container' => $formField['attributes']['no_container']],
                    ['no_seal' => $formField['attributes']['no_seal'], 'asal_barang' => $formField['attributes']['asal_barang'], 'tgl_serah_barang' => $formField['attributes']['tgl_serah_barang']]
                );

                if (isset($this->barangFields[$formField['id']])) {
                    // dd($this->barangFields[$formField['id']]);
                    foreach ($this->barangFields[$formField['id']] as $index => $barangField) {
                        $p = $barangField['attributes']['p'];
                        $l = $barangField['attributes']['l'];
                        $t = $barangField['attributes']['t'];
                        $jumlah_barang = $barangField['attributes']['jml_barang'];
                        $jumlah_kubikasi = round(($p * $l * $t * $jumlah_barang) / 1000);

                        // Increment the total
                        $totalJumlahKubikasi += $jumlah_kubikasi;

                        if(!empty($this->deletedItems)){
                          
                            $itemDelete = Item::findOrFail(optional($this->deletedItems[$index]['attributes']['id']));
                            // dd($itemDelete);
                            $itemDelete->delete();

                        }
                       
                       
                         
                        Item::updateOrCreate(
                            [
                                'id' => optional($barangField['attributes'])['id'],
                            ],
                            [
                                'container_id' => $container->id,
                                'nama_barang' => $barangField['attributes']['nama_barang'],
                                'jml_barang' => $barangField['attributes']['jml_barang'],
                                'satuan_barang' => $barangField['attributes']['satuan_barang'],
                                'kg' => $barangField['attributes']['kg'],
                                'p' => $barangField['attributes']['p'],
                                'l' => $barangField['attributes']['l'],
                                't' => $barangField['attributes']['t'],
                                'jumlah_kubikasi' => $barangField['attributes']['jumlah_kubikasi'],
                            ]
                        );

                        // dd($this->barangFields);
                    }
                }
            }

            // Update the jumlah_kubikasi for the ResiModel
            $resi = ResiModel::updateOrCreate(['id' => $resiId], [
                'jumlah_kubikasi' => $totalJumlahKubikasi
            ]);

            
            $this->dispatch('notify', title: 'success', message: 'Data Resi berhasil diupdate');
            session()->flash('message', 'Data Resi berhasil ditambahkan');
            return redirect('/resi');
        } catch (ValidationException $e) {
            // Handle validation errors
            $this->dispatch('notify', title: 'error', message: 'An error occured. Please check all fields.');
            // You can access validation error messages using $e->errors()
        } catch (QueryException $e) {
            // Handle database query errors
            // You can log the error or perform other actions
            $this->dispatch('notify', title: 'error', message: $e . 'An error occurred while saving the data.');
        }
    }

    // Other methods for adding/removing fields can be similar to the ResiPost component


    public function addFormField()
    {
        $formFieldId = uniqid();
        $this->formFields[] = [
            'id' => $formFieldId,
            'attributes' => [
                'no_container' => '',
                'no_seal' => '',
                'asal_barang' => '',
                'tgl_serah_barang' => '',

            ],
        ];

        $this->barangFields[$formFieldId] = []; // Initialize an empty array for barangFields
    }

    public function addBarangField($formFieldId)
    {
        $this->barangFields[$formFieldId][] = ['id' => uniqid()];
    }






    public function removeFormField($formFieldId)
    {
        // Check if the form field with the specified id exists in formFields
        foreach ($this->formFields as $index => $formField) {
            // Check if the formField array has an 'id' key and if it matches the formFieldId
            if (isset($formField['id']) && $formField['id'] === $formFieldId) {
                // Check if the associated barang field exists in barangFields array
                if (isset($this->barangFields[$formFieldId])) {
                    // Find the key of the barangFieldId in the associated barangFields array
                    $key = array_search($formFieldId, array_column($this->barangFields[$formFieldId], 'id'));

                    // Check if the key is found and unset the associated barangFields entry
                    if ($key !== false) {
                        unset($this->barangFields[$formFieldId][$key]);
                    }
                }

                // Remove the form field at the found index
                unset($this->formFields[$index]);
                unset($this->barangFields[$formFieldId]);
                $this->resetErrorBag();

                break; // Stop loop once found and removed
            }
        }
    }


    public function removeBarangField($formFieldId, $barangFieldId)
    {
        // Check if the formFieldId exists in barangFields array
        if (isset($this->barangFields[$formFieldId])) {
            // Check if the barangFieldId exists in the formFieldId sub-array
            $key = array_search($barangFieldId, array_column($this->barangFields[$formFieldId], 'id'));

            if ($key !== false) {
                // Remove the element at the specified key
                $this->deletedItems[] =$this->barangFields[$formFieldId][$key];
                unset($this->barangFields[$formFieldId][$key]);
                $this->resetErrorBag();

                // Reset array keys after removal
                $this->barangFields[$formFieldId] = array_values($this->barangFields[$formFieldId]);
            }
        }

      
    }

}
