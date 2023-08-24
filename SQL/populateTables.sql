INSERT INTO customer
    (email, firstname, lastname, telephone, password)
    VALUES 
        ('amanda@mbl.com', 'Amanda', 'Sherman', '123-456-7890', 'hashedpassword'),
        ('caleb@mbl.com', 'Caleb', 'Rummel', '123-456-7890', 'hashedpassword'),
        ('karendaysu@mbl.com', 'Karendaysu', 'Wolfe', '123-456-7890', 'hashedpassword'),
        ('robin@mbl.com', 'Robin', 'Pindel', '123-456-7890', 'hashedpassword');

INSERT INTO reservation
    (customerid, checkin, checkout, numberguests, roomsize)
    VALUES
        (1, '2023-01-01', '2023-01-05', 2, 'Double Full'),
        (2, '2023-09-01', '2023-09-05', 2, 'Double Queen'),
        (3, '2023-10-15', '2023-10-20', 1, 'Queen'),
        (4, '2023-11-01', '2023-11-07', 2, 'King');