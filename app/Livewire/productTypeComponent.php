<?php 

namespace App\Livewire;

use Illuminate\Http\Request;
use App\Models\ProductType;
use Livewire\Component;

class ProductTypeComponent extends Component
{
    public $id;
    public $name;
    public $productTypes = [];
    // modal
    public $showModal = false;
    public $editing = false;
    

    public function fetchData() {
        $this->productTypes = ProductType::orderBy('id', 'desc')->get();
    }
       
        //function modal create
    public function create(){
        $this->showModal = true;
    }
    
    public function save() {
         //ถ้ามีการส่ง ID มาให้ไปค้นข้อมูลก่อน
        if ($this->id) {
            $productType = ProductType::find($this->id);
        } else {
        //ถ้าไม่มีการส่ง ID มาให้สร้าง Object ขึ้นใหม่
            $productType = new ProductType();
        }
        //ข้อมูลที่จะเก็บลงฐานข้อมูล = ข้อมูลที่รับจาก Request
        $productType->name = $this->name;
        $productType->save();
        //เมื่อ Save แล้วให้มีค่าว่างใน input
        $this->name = '';
        
        // ข้อมูลใหม่
        $this->fetchData();

       // ปิดกล่อง modal
       $this->editing = false;
       $this->showModal = false;
    }

    public function edit($id) {
        //function modal create
         $this->editing = true;
         $this->showModal = true;
        
        $productType = ProductType::find($id);
        $this->id = $productType->id;
        $this->name = $productType->name;
    }

    public function remove($id) {
        $productType = ProductType::find($id);
        $productType->delete();

        $this->fetchData();
    }

    public function render() {
        $this->fetchData();
        return view('livewire.productType');
    }
}