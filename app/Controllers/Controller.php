<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProvinceModel;
use App\Models\OfficeModel;
use App\Models\SiteModel;
use App\Models\ApartmentModel;
use App\Models\CustomerModel;
use App\Models\OfficerModel;
use App\Models\SaleModel;

class Controller extends BaseController
{
    public function loginView()
    {
        return view('LoginView');
    }

    public function login()
    {
        $session = session();
        $officer = new OfficerModel();
        $data = $officer->where('OfficerUName', $this->request->getVar('officeruname'))->first();
        if ($data) {
            $pass = $data['OfficerPword'];
            $authPword = password_verify($this->request->getVar('officerpword'), $pass);
            if ($authPword) {
                $sesData = [
                    'OfficerID' => $data['OfficerID'],
                    'OfficerName' => $data['OfficerName'],
                    'OfficerUName' => $data['OfficerUName'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($sesData);
                return redirect()->to(base_url('apartSelect'));
            } else {
                $session->setFlashdata("msg", "Le mot de passe est incorrect!");
                return redirect()->to(base_url('loginView'));
            }
        } else {
            $session->setFlashdata("msg", "Le nom d'utilisateur n'existe pas!");
            return redirect()->to(base_url('loginView'));
        }
    }

    public function logout()
    {
        $session = session();
        $sesData = ['OfficerID', 'OfficerName', 'OfficerUName', 'isLoggedIn'];
        $session->remove($sesData);
        return redirect()->to(base_url('loginView'));
    }

    public function saleSelect()
    {
        $session = session();
        if ($session->get('OfficerName') != 'Admin') {
            return redirect()->to(base_url('apartSelect'));
        }
        $data['officerid'] = $session->get('OfficerID');
        $data['officername'] = $session->get('OfficerName');
        $data['officeruname'] = $session->get('OfficerUName');
        $sale = new SaleModel();
        $data['sale'] = $sale
            ->join('apartment', 'sale.ApartID = apartment.ApartID', 'left')
            ->join('customer', 'sale.CustID = customer.CustID', 'left')
            ->join('officer', 'sale.OfficerID = officer.OfficerID', 'left')
            ->join('site', 'apartment.SiteID = site.SiteID', 'left')
            ->join('office', 'site.OfficeID = office.OfficeID', 'left')
            ->join('province', 'office.ProvinceID = province.ProvinceID', 'left')
            ->orderBy('SaleDate', 'DESC')->findAll();
        return view('SaleView', $data);
    }

    public function saleInsert($apartid)
    {
        $sale = new SaleModel();
        $apart = new ApartmentModel();
        $data = [
            'SaleTotal' => $this->request->getPost('saletotal'),
            'SaleType' => $this->request->getPost('saletype'),
            'ApartID' => $apartid,
            'CustID' => $this->request->getPost('custid'),
            'OfficerID' => $this->request->getPost('officerid')
        ];
        $sale->save($data);
        $data2 = [
            'CustID' => $this->request->getPost('custid')
        ];
        $apart->update($apartid, $data2);
        return redirect()->to(base_url('apartSelect'));
    }

    public function provinceInsert()
    {
        $province = new ProvinceModel();
        $data = [
            'ProvinceName' => $this->request->getPost('provincename')
        ];
        $province->save($data);
        return redirect()->to(base_url('officeSelect'));
    }

    public function provinceUpdate($proid)
    {
        $province = new ProvinceModel();
        $data = [
            'ProvinceName' => $this->request->getPost('provincename')
        ];
        $province->update($proid, $data);
        return redirect()->to(base_url('officeSelect'));
    }

    public function provinceDelete($proid)
    {
        $province = new ProvinceModel();
        $province->delete($proid);
        return redirect()->to(base_url('officeSelect'));
    }

    public function officeSelect()
    {
        $session = session();
        $data['officerid'] = $session->get('OfficerID');
        $data['officername'] = $session->get('OfficerName');
        $data['officeruname'] = $session->get('OfficerUName');
        $office = new OfficeModel();
        $province = new ProvinceModel();
        $data['office'] = $office
            ->join('province', 'office.ProvinceID = province.ProvinceID', 'left')->findAll();
        $data['province'] = $province->findAll();
        return view('OfficeView', $data);
    }

    public function officeInsert()
    {
        $office = new OfficeModel();
        $data = [
            'OfficeName' => $this->request->getPost('officename'),
            'OfficeAddress' => $this->request->getPost('officeaddress'),
            'ProvinceID' => $this->request->getPost('provinceid')
        ];
        $office->save($data);
        return redirect()->to(base_url('officeSelect'));
    }

    public function officeUpdate($offid)
    {
        $office = new OfficeModel();
        $data = [
            'OfficeName' => $this->request->getPost('officename'),
            'OfficeAddress' => $this->request->getPost('officeaddress'),
            'ProvinceID' => $this->request->getPost('provinceid')
        ];
        $office->update($offid, $data);
        return redirect()->to(base_url('officeSelect'));
    }

    public function officeDelete($offid)
    {
        $office = new OfficeModel();
        $office->delete($offid);
        return redirect()->to(base_url('officeSelect'));
    }

    public function siteSelect()
    {
        $session = session();
        $data['officerid'] = $session->get('OfficerID');
        $data['officername'] = $session->get('OfficerName');
        $data['officeruname'] = $session->get('OfficerUName');
        $site = new SiteModel();
        $office = new OfficeModel();
        $data['site'] = $site
            ->join('office', 'site.OfficeID = office.OfficeID', 'left')->findAll();
        $data['office'] = $office->findAll();
        return view('SiteView', $data);
    }

    public function siteInsert()
    {
        $site = new SiteModel();
        $data = [
            'SiteLocation' => $this->request->getPost('sitelocation'),
            'SiteArea' => $this->request->getPost('sitearea'),
            'OfficeID' => $this->request->getPost('officeid')
        ];
        $site->save($data);
        return redirect()->to(base_url('siteSelect'));
    }

    public function siteUpdate($siteid)
    {
        $site = new SiteModel();
        $data = [
            'SiteLocation' => $this->request->getPost('sitelocation'),
            'SiteArea' => $this->request->getPost('sitearea'),
            'OfficeID' => $this->request->getPost('officeid')
        ];
        $site->update($siteid, $data);
        return redirect()->to(base_url('siteSelect'));
    }

    public function siteDelete($siteid)
    {
        $site = new SiteModel();
        $site->delete($siteid);
        return redirect()->to(base_url('siteSelect'));
    }

    public function apartSelect()
    {
        $session = session();
        $data['officerid'] = $session->get('OfficerID');
        $data['officername'] = $session->get('OfficerName');
        $data['officeruname'] = $session->get('OfficerUName');
        $apart = new ApartmentModel();
        $site = new SiteModel();
        $cust = new CustomerModel();
        $officer = new OfficerModel();
        $data['apart'] = $apart
            ->join('site', 'apartment.SiteID = site.SiteID', 'left')
            ->join('customer', 'apartment.CustID = customer.CustID', 'left')
            ->join('office', 'site.OfficeID = office.OfficeID', 'left')
            ->join('province', 'office.ProvinceID = province.ProvinceID', 'left')->findAll();
        $data['site'] = $site->findAll();
        $data['cust'] = $cust->findAll();
        return view('ApartmentView', $data);
    }

    public function apartInsert()
    {
        helper(['form', 'url']);
        $apart = new ApartmentModel();
        if ($this->request->getFile('apartimg')->getName() != null) {
            $this->request->getFile('apartimg')->move(WRITEPATH . 'uploads', null, true);
            $apartimg = base64_encode(file_get_contents(WRITEPATH . 'uploads\\' . $this->request->getFile('apartimg')->getName()));
        }
        $data = [
            'ApartAddress' => $this->request->getPost('apartaddress'),
            'ApartPrice' => $this->request->getPost('apartprice'),
            'SiteID' => $this->request->getPost('siteid')
        ];
        if ($this->request->getFile('apartimg')->getName() != null) {
            $data['ApartImg'] = $apartimg;
        }
        $apart->save($data);
        return redirect()->to(base_url('apartSelect'));
    }

    public function apartUpdate($apartid)
    {
        helper(['form', 'url']);
        $apart = new ApartmentModel();
        if ($this->request->getFile('apartimg')->getName() != null) {
            $this->request->getFile('apartimg')->move(WRITEPATH . 'uploads', null, true);
            $apartimg = base64_encode(file_get_contents(WRITEPATH . 'uploads\\' . $this->request->getFile('apartimg')->getName()));
        }
        $data = [
            'ApartAddress' => $this->request->getPost('apartaddress'),
            'ApartPrice' => $this->request->getPost('apartprice'),
            'SiteID' => $this->request->getPost('siteid')
        ];
        if ($this->request->getFile('apartimg')->getName() != null) {
            $data['ApartImg'] = $apartimg;
        }
        $apart->update($apartid, $data);
        return redirect()->to(base_url('apartSelect'));
    }

    public function apartDelete($apartid)
    {
        $apart = new ApartmentModel();
        $apart->delete($apartid);
        return redirect()->to(base_url('apartSelect'));
    }

    public function custSelect()
    {
        $session = session();
        $data['officerid'] = $session->get('OfficerID');
        $data['officername'] = $session->get('OfficerName');
        $data['officeruname'] = $session->get('OfficerUName');
        $cust = new CustomerModel();
        $apart = new ApartmentModel();
        $data['cust'] = $cust->findAll();
        $data['apart'] = $apart
            ->join('customer', 'apartment.CustID = customer.CustID', 'left')->findAll();
        return view('CustomerView', $data);
    }

    public function custInsert()
    {
        $cust = new CustomerModel();
        $data = [
            'CustName' => $this->request->getPost('custname'),
            'CustPNum' => $this->request->getPost('custpnum'),
            'CustAddress' => $this->request->getPost('custaddress')
        ];
        $cust->save($data);
        return redirect()->to(base_url('custSelect'));
    }

    public function custQuiInsert()
    {
        $cust = new CustomerModel();
        $data = [
            'CustName' => $this->request->getPost('custname'),
            'CustPNum' => $this->request->getPost('custpnum'),
            'CustAddress' => $this->request->getPost('custaddress')
        ];
        $cust->save($data);
        return redirect()->to(base_url('apartSelect'));
    }

    public function custUpdate($custid)
    {
        $cust = new CustomerModel();
        $data = [
            'CustName' => $this->request->getPost('custname'),
            'CustPNum' => $this->request->getPost('custpnum'),
            'CustAddress' => $this->request->getPost('custaddress')
        ];
        $cust->update($custid, $data);
        return redirect()->to(base_url('custSelect'));
    }

    public function custDelete($custid)
    {
        $cust = new CustomerModel();
        $cust->delete($custid);
        return redirect()->to(base_url('custSelect'));
    }

    public function officerSelect()
    {
        $session = session();
        if ($session->get('OfficerName') != 'Admin') {
            return redirect()->to(base_url('apartSelect'));
        }
        $data['officerid'] = $session->get('OfficerID');
        $data['officername'] = $session->get('OfficerName');
        $data['officeruname'] = $session->get('OfficerUName');
        $officer = new OfficerModel();
        $data['officer'] = $officer
            ->select('officer.*, COUNT(CustID) AS SaleNb')
            ->join('sale', 'officer.OfficerID = sale.OfficerID', 'left')
            ->groupBy('officer.OfficerID')
            ->orderBy('SaleNb', 'DESC')
            ->where("OfficerName != 'Admin'")->findAll();
        return view('OfficerView', $data);
    }

    public function officerInsert()
    {
        $officer = new OfficerModel();
        $data = [
            'OfficerName' => $this->request->getVar('officername'),
            'OfficerPNum' => $this->request->getVar('officerpnum'),
            'OfficerAddress' => $this->request->getVar('officeraddress'),
            'OfficerUName' => $this->request->getVar('officeruname'),
            'OfficerPword' => password_hash($this->request->getVar('officerpword'), PASSWORD_DEFAULT)
        ];
        $officer->save($data);
        return redirect()->to(base_url('officerSelect'));
    }

    public function officerUpdate($officerid)
    {
        $officer = new OfficerModel();
        $data = [
            'OfficerName' => $this->request->getVar('officername'),
            'OfficerPNum' => $this->request->getVar('officerpnum'),
            'OfficerAddress' => $this->request->getVar('officeraddress'),
            'OfficerUName' => $this->request->getVar('officeruname')
        ];
        if ($this->request->getVar('officerpword') != null) {
            $data['OfficerPword'] = password_hash($this->request->getVar('officerpword'), PASSWORD_DEFAULT);
        }
        $officer->update($officerid, $data);
        return redirect()->to(base_url('officerSelect'));
    }

    public function officerAccUpdate($officerid)
    {
        $officer = new OfficerModel();
        $data = [
            'OfficerUName' => $this->request->getVar('officeruname')
        ];
        if ($this->request->getVar('officerpword') != null) {
            $data['OfficerPword'] = password_hash($this->request->getVar('officerpword'), PASSWORD_DEFAULT);
        }
        $officer->update($officerid, $data);
        return redirect()->to(base_url('apartSelect'));
    }

    public function officerDelete($officerid)
    {
        $officer = new OfficerModel();
        $officer->delete($officerid);
        return redirect()->to(base_url('officerSelect'));
    }
}
