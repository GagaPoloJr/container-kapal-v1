<?php

namespace App\Livewire\Resi;

use App\Models\Container;
use App\Models\Customer;
use App\Models\Item;
use App\Models\ResiModel;
use App\Models\Setting;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ResiPost extends Component
{

    public $formFields = [];
    public $barangFields = [];
    public $customers, $setting;
    public $selectedItem;
    public $modelValue;
    public $resi_id, $tipe_muatan, $no_resi, $nama_pengirim, $nama_penerima, $trip_tujuan, $kota_keberangkatan, $kota_tujuan, $tgl_berangkat, $kapal_muatan;

    protected $listeners = ['selectOption'];

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

    public function mount()
    {
        $this->addFormField();
        $this->customers = Customer::all();
        // Fetch and set the value of $setting
        $this->setting = Setting::findOrFail(1);

    }

    public function render()
    {
        return view('livewire.resi.create');
    }


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


    // public function messages()
    // {
    //     return [
    //         'formFields.*.attributes.no_container.required' => 'The No Container field is required.',
    //         'formFields.*.attributes.no_seal.required' => 'The No Seal field is required.',
    //         'formFields.*.attributes.asal_barang.required' => 'The Nama Pengirim field is required.',
    //         'formFields.*.attributes.tgl_serah_barang.required' => 'The Tanggal Serah Barang field is required.',
    //         'barangFields.*.*.attributes.nama_barang.required' => 'The Nama Barang field is required.',
    //         'barangFields.*.*.attributes.jml_barang.required' => 'The Jumlah Barang field is required.',
    //         'barangFields.*.*.attributes.satuan_barang.required' => 'The Satuan Barang field is required.',
    //         // 'barangFields.*.*.attributes.kg.required' => 'The Kg field is required.',
    //         'barangFields.*.*.attributes.p.required' => 'The P field is required.',
    //         'barangFields.*.*.attributes.l.required' => 'The L field is required.',
    //         'barangFields.*.*.attributes.t.required' => 'The T field is required.',
    //         'barangFields.*.*.attributes.jumlah_kubikasi.required' => 'The Jumlah Kubikasi field is required.',
    //     ];
    // }
    // $formFields = [
    //     ['id' => 'some_id', 'attributes' => ['no_container' => 'value1', 'no_seal' => 'value2', 'asal_barang' => 'value3']],
    //     // ... other form fields
    // ];

    // $barangFields = [
    //     'some_form_field_id' => [
    //         ['id' => 'some_id', 'attributes' => ['nama_barang' => 'value4', 'jml_barang' => 'value5', 'satuan_barang' => 'value6', 'kg' => 'value7', 'p' => 'value8', 'l' => 'value9', 't' => 'value10', 'jumlah_kubikasi' => 'value11']],
    //         // ... other barang fields for the same form field
    //     ],
    //     // ... other form fields and their associated barang fields
    // ];

    public function getJumlahKubikasi($formFieldId, $index)
    {
        // Check if 'attributes' key exists in barangFields
        if (isset($this->barangFields[$formFieldId][$index]['attributes'])) {
            $p = $this->barangFields[$formFieldId][$index]['attributes']['p'];
            $l = $this->barangFields[$formFieldId][$index]['attributes']['l'];
            $t = $this->barangFields[$formFieldId][$index]['attributes']['t'];
            // Calculate jumlah_kubikasi based on p, l, and t
            $jumlahKubikasi = $p * $l * $t;


            // Return the calculated value
            return $jumlahKubikasi;
        }

        // Return default value or handle the case where 'attributes' key is not set
        return 0;
    }


    public function calculateJumlahKubikasi($formFieldId, $index)
    {
        // Check if the array and the keys exist before accessing them
        if (
            isset($this->barangFields[$formFieldId][$index]['attributes']['p']) &&
            isset($this->barangFields[$formFieldId][$index]['attributes']['l']) &&
            isset($this->barangFields[$formFieldId][$index]['attributes']['t'])
            &&
            isset($this->barangFields[$formFieldId][$index]['attributes']['jml_barang'])
        ) {
            // Convert values to float to ensure numeric calculations
            $p = (float) $this->barangFields[$formFieldId][$index]['attributes']['p'];
            $l = (float) $this->barangFields[$formFieldId][$index]['attributes']['l'];
            $t = (float) $this->barangFields[$formFieldId][$index]['attributes']['t'];
            $jml_barang = (float) $this->barangFields[$formFieldId][$index]['attributes']['jml_barang'];

            // Check if conversion is successful before performing calculations
            if (!is_nan($p) && !is_nan($l) && !is_nan($t) && !is_nan($jml_barang)) {
                // Calculate jumlah_kubikasi based on p, l, and t
                $jumlahKubikasi = ($jml_barang * $p * $l * $t) / 1000;

                // Update the value in the Livewire data array
                $this->barangFields[$formFieldId][$index]['attributes']['jumlah_kubikasi'] = round($jumlahKubikasi);
            }
        }
    }



    public function validateTipeMuatan()
    {
        $this->validate([
            'tipe_muatan' => 'required', // Add your validation rules as needed
        ]);
    }

    public function store()
    {
        // dd($this);
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
                // 'nama_pengirim' => $this->nama_pengirim,
                'nama_penerima' => $this->nama_penerima,
                'trip_ke' => $this->trip_tujuan,
                'kota_keberangkatan' => $this->kota_keberangkatan,
                'kota_tujuan' => $this->kota_tujuan,
                'tgl_berangkat' => $this->tgl_berangkat,

            ];
            $resi = ResiModel::updateOrCreate(['id' => $this->resi_id], $resi_data);
            $resiId = $resi->id;

            $totalJumlahKubikasi = 0; // Initialize the total
            foreach ($this->formFields as $formField) {
                $container = Container::create([
                    'resi_id' => $resiId,
                    'no_container' => $formField['attributes']['no_container'],
                    'no_seal' => $formField['attributes']['no_seal'],
                    'asal_barang' => $formField['attributes']['asal_barang'],
                    'tgl_serah_barang' => $formField['attributes']['tgl_serah_barang'],
                ]);

                if (isset($this->barangFields[$formField['id']])) {
                    foreach ($this->barangFields[$formField['id']] as $barangField) {

                        $p = $barangField['attributes']['p'];
                        $l = $barangField['attributes']['l'];
                        $t = $barangField['attributes']['t'];
                        $jumlah_barang = $barangField['attributes']['jml_barang'];
                        $jumlah_kubikasi = round(($p * $l * $t * $jumlah_barang) / 1000);

                        // Increment the total
                        $totalJumlahKubikasi += $jumlah_kubikasi;
                        Item::create([
                            'container_id' => $container->id,
                            'jml_barang' => $barangField['attributes']['jml_barang'],
                            'satuan_barang' => $barangField['attributes']['satuan_barang'],
                            'nama_barang' => $barangField['attributes']['nama_barang'],
                            'kg' => isset($barangField['attributes']['kg']) ? $barangField['attributes']['kg'] : null,
                            'p' => $barangField['attributes']['p'],
                            'l' => $barangField['attributes']['l'],
                            't' => $barangField['attributes']['t'],
                            'jumlah_kubikasi' => $barangField['attributes']['jumlah_kubikasi'],
                        ]);
                    }
                }
            }

            $resi = ResiModel::updateOrCreate(['id' => $resiId], [
                'total_kubikasi' => $totalJumlahKubikasi
            ]);
            $this->dispatch('notify', title: 'success', message: 'Data Resi berhasil ditambahkan');
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
                // Reassign to new arrays
                // $this->formFields = array_values($this->formFields);
                // $this->barangFields = array_values($this->barangFields);

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
                unset($this->barangFields[$formFieldId][$key]);
                $this->resetErrorBag();

                // Reset array keys after removal
                $this->barangFields[$formFieldId] = array_values($this->barangFields[$formFieldId]);
            }
        }
    }




}

