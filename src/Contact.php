<?
// all
public function all()
{
$contacts = [];
$stmt = $this->db->prepare('SELECT * FROM contacts');
$stmt->execute();
while($row = $stmt->fetch())
{
      $contact = new Contact($this->db);
      $contact->fillFromDB($row);
      $contacts[] = $contact;
}

return $contacts;
}

// fillFromDB
protected function fillFromDB(array $row)
{
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->phone = $row['phone'];
      $this->notes = $row['notes'];
      $this->created_at = $row['created_at'];
      $this->updated_at = $row['updated_at'];

      return $this;
}

// save
public function save()
{
      $resutl = false;
      if($this->id >= 0)
      {
            $stmt = $this->db->prepare('update contacts set name = :name,
             phone = :phone, notes = :notes,
              updated_at = now() where id = :id');
            $result = $stmt->execute([
                  'name' => $this->name,
                  'phone' => $this->phone,
                  'notes' => $this->notes,
                  'id' => $this->id,
            ]);
      }else {
            $stmt = $this->db->prepare(
                  'INSERT INTO contacts (name, phone, notes, created_at, update_at) 
                  values 
                  (:name, :phone, :notes, now(), now())'
            );

            $result = $stmt->execute([
                  'name' => $this->name,
                  'name' => $this->name,
                  'name' => $this->name,
            ]);
            if($result)
            {
                  $this->id = $this->db->lastInsertId();
            }
      }
      return $result;
}

// find
public function find($id)
{
      $stmt = $this->db->prepare('SELECT * FROM contacts WHERE id = :id');
      $stmt->execute(['id' => $id]);
      if($row = $stmt->fetch())
      {
            $this->fillFromDB($row);
            return $this;
      }
      return null;
}

// update
public function update(array $data)
{
      $this->fill($data);
      if($this->validate())
      {
            return $this->save();
      }
      return false;
}

// delelte 
public function delete()
{
      $stmt = $this->db->prepare('DELETE FROM contacts WHERE id = :id');
      return $stmt->execute(['id' => $this->id]);
}
