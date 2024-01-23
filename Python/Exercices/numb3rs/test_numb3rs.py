from numb3rs import validate

def test_values():
    assert validate("a55.255.255.255") == False
    assert validate("1.1.1.999") == False
    assert validate("256.256.256.256") == False
    assert validate("255.255.255.255") == True
    assert validate("0.0.0.0") == True

def test_format():
    assert validate("0.0.0") == False
    assert validate("0.0.0.0.0") == False
    
