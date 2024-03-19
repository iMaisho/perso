from um import count

def test_values():
    assert count("um") == 1


def test_format():
    assert count("UM") == 1
    assert count("um...") == 1
    assert count (",um ,") == 1
    assert count (" um ") == 1

def test_exceptions():
    assert count("Yummy !") == 0
    assert count("Um, thanks for the album.") == 1




