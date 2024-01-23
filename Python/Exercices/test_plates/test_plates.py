from plates import is_valid

def test_condition1():
    assert is_valid("12") == False
    assert is_valid("12ABCD") == False
    assert is_valid("AA") == True
    assert is_valid("123456") == False

def test_condition2():
    assert is_valid("A") == False
    assert is_valid("AA12345") == False

def test_condition3():
    assert is_valid("AA12AA") == False

def test_condition4():
    assert is_valid("AA0123") == False

def test_condition5():
    assert is_valid("AA123!") == False


